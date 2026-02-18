<?php

namespace App\Controller\Clients;

use App\Repository\TripRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/trip', name: 'ajax')]
class AjaxController extends AbstractController
{
    #[Route('/search', name: 'test')]
    public function index(
        TripRepository $tripRepository,
        SerializerInterface $serializer,

    ): JsonResponse
    {
        $trips = $tripRepository->findAll();

        $tripsContent = [];
        foreach ($trips as $trip) {
            $tripsContent [] = $trip->getDepartureDay();
        }
        // $trip = [
        //     'name' => 'John Doe',
        //     'role' => 'Driver',
        //     'pseudo' => 'toto',
        // ];
        $jsonContent = $serializer->serialize($tripsContent, 'json'); // Transforme le tab en json

        return JsonResponse::fromJsonString($jsonContent); // Retourne en Json
    }
}