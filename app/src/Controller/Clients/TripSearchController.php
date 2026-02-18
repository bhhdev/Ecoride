<?php

namespace App\Controller\Clients;

use App\Repository\TripRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/trip-search', name: 'ajax')]
class TripSearchController extends AbstractController
{
    #[Route('', name: 'test')]
    public function index(
        TripRepository $tripRepository,
        Request $request
    ): JsonResponse
    {
        $departure = $request->query->get('departure');
        $arrival   = $request->query->get('arrival');
        $date      = $request->query->get('date');

        $trips = $tripRepository->findTrips($departure,$arrival,$date);

        $data = array_map(
            function($trip) {

                $driver = $trip->getUser();
                $vehicle = $trip->getVehicle();

                return [
                    'driver' => [
                        'firstname'   => $driver?->getFirstname(),
                        'lastname'    => $driver?->getLastname(),
                        'displayName' => trim(
                            ($driver?->getFirstname() ?? '') . ' ' . ($driver?->getLastname() ?? '')
                        ),
                        'avatar' => $driver?->getAvatarUrl(),
                        'note' => null
                    ],
                    'trip' => [
                        'from'      => $trip->getDepartureCity(),
                        'to'        => $trip->getArrivalCity(),
                        'date'      => $trip->getDepartureDay()->format('Y-m-d'),
                        'timeStart' => $trip->getDepartureDay()->format('H:i'),
                        'timeEnd'   => $trip->getArrivalDay()->format('H:i'),
                        'seatsLeft' => $trip->getSeatAvailable(),
                        'eco'       => $vehicle->getEnergy() === 'electric',
                        'status'    => $trip->getStatus()
                    ],
                    'price' => [
                        'credits' => $trip->getSeatPrice()
                    ]
                ];
            },
            $trips
        );

        return new JsonResponse($data);
    }
}
