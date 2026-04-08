<?php

namespace App\Controller\Clients;

use App\Entity\Booking;
use App\Repository\TripRepository;
use App\Service\HandleCreditsService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class BookingController extends AbstractController
{
    #[Route('/booking/create', name: 'booking_create', methods: ['POST'])]
    public function create(
        HandleCreditsService $handleCreditsService,
        Request $request,
        TripRepository $tripRepository,
        EntityManagerInterface $em,
    ): JsonResponse {

        $data = json_decode($request->getContent(), true);

        $tripId = $data['tripId'] ?? null;

        if (!$tripId) {
            return new JsonResponse(['error' => 'Trip manquant'], 400);
        }

        $trip = $tripRepository->find($tripId);

        if (!$trip) {
            return new JsonResponse(['error' => 'Trip introuvable'], 404);
        }

        if ($trip->getSeatAvailable() <= 0) {
            return new JsonResponse(['error' => 'Plus de places'], 400);
        }

        $user = $this->getUser();

        if (!$user) {
            return new JsonResponse(['error' => 'Non connecté'], 401);
        }

        // ✅ décrément côté serveur
        $trip->decrementSeatAvailable();

        // ✅ création booking
        $booking = new Booking();
        $booking->setUser($user);
        $booking->setTrip($trip);
        $booking->setSeatNumber(1); // simplifié

        $em->persist($booking);
        $em->flush();

        // ✅ gestion crédits du passager et du conducteur
        $handleCreditsService->manageCredits($booking, $trip);

        return new JsonResponse([
            'success' => true,
            'seatsLeft' => $trip->getSeatAvailable()
        ]);
    }
}