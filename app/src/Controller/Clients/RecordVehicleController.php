<?php

namespace App\Controller\Clients;

use App\Entity\Vehicle;
use App\Form\VehicleType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/clients/record-vehicle')]
class RecordVehicleController extends AbstractController
{
    #[Route('/', name: 'app_clients_record_vehicle')]
    public function index(
        Request $request,
        EntityManagerInterface $entityManager
    ): Response {

        $this->denyAccessUnlessGranted('ROLE_USER');

        $vehicle = new Vehicle();

        $form = $this->createForm(VehicleType::class, $vehicle);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $vehicle->setOwner($this->getUser());

            $entityManager->persist($vehicle);
            $entityManager->flush();

            return $this->redirectToRoute('app_clients_personal_space');
        }

        return $this->render('clients/record_vehicle/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}