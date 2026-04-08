<?php

namespace App\Controller\Clients;

use App\Entity\Trip;
use App\Entity\User;
use App\Entity\Preference;
use App\Form\NewTripType;
use App\Form\AddCreditsType;
use App\Repository\TripRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

final class PersonalSpaceController extends AbstractController
{
    #[Route('/espace_perso', name: 'app_clients_personal_space')]
    public function index(
        Request $request,
        EntityManagerInterface $entityManager,
        TripRepository $tripRepository
    ): Response {

        $this->denyAccessUnlessGranted('ROLE_USER');

        /** @var User $user */
        $user = $this->getUser();

        $trip = new Trip();

        $form = $this->createForm(NewTripType::class, $trip, [
            'user' => $user
        ]);

        //  AJOUT FORMULAIRE CRÉDIT
        $formAddCredits = $this->createForm(AddCreditsType::class);
        $formAddCredits->handleRequest($request);

        $form->handleRequest($request);

        //  TRAITEMENT FORM CRÉDIT
        if ($formAddCredits->isSubmitted() && $formAddCredits->isValid()) {

            $data = $formAddCredits->getData();
            $creditsToAdd = (int) $data['credits'];

            $currentSolde = $user->getSolde();
            $maxAddable = 9999 - $currentSolde;

            if ($creditsToAdd <= 0) {
                $this->addFlash('error', 'Veuillez entrer un nombre valide');

            } elseif ($creditsToAdd > $maxAddable) {
                $this->addFlash(
                    'error',
                    "Vous pouvez ajouter au maximum {$maxAddable} crédits"
            );

            } else {
                $user->setSolde($currentSolde + $creditsToAdd);
                $entityManager->flush();

                $this->addFlash(
                    'success',
                    "Votre solde a bien été crédité de {$creditsToAdd} crédits"
            );
        }

            return $this->redirectToRoute('app_clients_personal_space');
        }

        if ($form->isSubmitted() && $form->isValid()) {

            $trip->setUser($user);

            $preference = new Preference();

            $preference->setSmokeVap(
                $form->get('smokeVap')->getData()
            );

            $preference->setAnimalsAccepted(
                $form->get('animalsAccepted')->getData()
            );

            $preference->setAirConditioning(
                $form->get('airConditioning')->getData()
            );

            $trip->setPreference($preference);

            $trip->setSeatAvailable($trip->getSeatAvailable() ?? 1);

            $this->addFlash('success', 'Bravo vous avez enregistré votre trajet de rêve...');

            $entityManager->persist($preference);
            $entityManager->persist($trip);
            $entityManager->flush();

            return $this->redirectToRoute('app_clients_personal_space');
        }

        $nextTrip = $tripRepository->createQueryBuilder('t')
            ->leftJoin('t.vehicle', 'v')->addSelect('v')
            ->leftJoin('t.bookings', 'b')->addSelect('b')
            ->leftJoin('b.user', 'u')->addSelect('u')
            ->andWhere('t.user = :user')
            ->andWhere('t.departureDay >= :now')
            ->setParameter('user', $user)
            ->setParameter('now', new \DateTime())
            ->orderBy('t.departureDay', 'ASC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();

        return $this->render('clients/personal_space/index.html.twig', [
            'form' => $form->createView(),
            'formAddCredits' => $formAddCredits->createView(), // ✅ AJOUT
            'vehicles' => $user->getVehicles(),
            'trip' => $nextTrip
        ]);
    }
}