<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CarpoolsController extends AbstractController
{
    #[Route('/covoiturages', name: 'app_carpools')]
    public function index(Request $request): Response
    {
        // Données fictives EXEMPLE
        $rides = [
            [
                'driverName' => 'Marie',
                'driverNote' => 4.9,
                'from' => 'Caen',
                'to' => 'Paris',
                'date' => '2025-05-18',
                'startTime' => '08:30',
                'endTime' => '11:15',
                'seats' => 2,
                'eco' => (bool) random_int(0, 1),     // >>> ICI <<<
                'price' => 15,
                'credits' => 150,
            ],
            [
                'driverName' => 'Paul',
                'driverNote' => 4.6,
                'from' => 'Caen',
                'to' => 'Rouen',
                'date' => '2025-05-19',
                'startTime' => '09:00',
                'endTime' => '10:20',
                'seats' => 1,
                'eco' => (bool) random_int(0, 1),     // >>> ICI <<<
                'price' => 8,
                'credits' => 80,
            ],
        ];

        return $this->render('carpools/index.html.twig', [
            'rides' => $rides
        ]);
    }
}
