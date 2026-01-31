<?php

namespace App\Controller\AStaff\Employee\Dashboard;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/a-staff/employee/covoiturage', name: 'employee_covoiturage_')]
class TripDetailController extends AbstractController
{
    #[Route('/detail/{id}', name: 'show', methods: ['GET'])]
    public function show(int $id): Response
    {
        // -------------------------------
        // COVOIT MOCK (aligné dashboard)
        // -------------------------------
        $date = new \DateTimeImmutable();
        $date = $date
            ->modify('-' . ($id % 5) . ' days')
            ->setTime(
                ($id * 3) % 24,
                ($id * 7) % 60,
                ($id * 11) % 60
            );

        $noteMin = ($id % 5) + 1;
        $isReclamation = $noteMin < 3;

        $covoit = [
            'id' => $id,
            'code' => $date->format('YmdHis'),
            'date' => $date,
            'from' => 'Paris',
            'to' => 'Lyon',
            'price' => 8,
            'eco' => (bool) ($id % 2),
            'driver' => [
                'firstname' => 'Jean',
                'lastname' => 'Dupont',
                'pseudo' => 'JD75',
                'email' => 'jean.dupont@mail.fr',
                'phone' => '01.23.45.67.89',
                'avgRate' => round(5 - ($noteMin / 2), 1),
                'trips' => 5,
            ],
        ];

        // -------------------------------
        // PASSAGERS MOCK (cohérents)
        // -------------------------------
        $passengers = [];
        $nbPassengers = ($id % 3) + 1;

        for ($i = 1; $i <= $nbPassengers; $i++) {

            // le 1er passager porte la note min
            $note = $i === 1 ? $noteMin : (($id + $i) % 2 === 0 ? 4 : null);
            $isReclam = $note !== null && $note < 3;

            $passengers[] = [
                'label' => 'passager ' . $i,
                'firstname' => 'Prenom' . $i,
                'lastname' => 'Nom' . $i,
                'pseudo' => 'user' . $i,
                'email' => "user{$i}@mail.fr",
                'phone' => '06.00.00.00.0' . $i,
                'trips' => ($id + $i) % 15 + 1,
                'avgRate' => round((($id + $i) % 5) + 0.5, 1),
                'note' => $note,
                'isReclamation' => $isReclam,
                'comment' => $note === null
                    ? null
                    : ($isReclam
                        ? 'Incident signalé lors du trajet.'
                        : 'Trajet agréable et respectueux.'),
            ];
        }

        return $this->render(
            'a_staff/employee/dashboard/trip_detail/index.html.twig',
            [
                'covoit' => $covoit,
                'passengers' => $passengers,
            ]
        );
    }
}
