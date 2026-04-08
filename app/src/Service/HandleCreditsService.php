<?php

namespace App\Service;

use App\Entity\User;
use App\Entity\Booking;
use App\Entity\Trip;
use Doctrine\ORM\EntityManagerInterface;


class HandleCreditsService
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }
    // Gérer les crédits pour les conducteurs et les passagers
    public function manageCredits(Booking $booking, Trip $trip)
    {
        // Récupert le trajet
        $trip = $booking->getTrip();

        // Récupert le conducteur et le passager
        $driver = $trip->getUser();
        $passenger = $booking->getUser();

        // Calculer le montant à créditer/débiter
        $amount = $trip->getSeatPrice(); // - prix d'une place pour le trajet
        $seatsBooked = $booking->getSeatNumber(); // - nombre de places réservées
        $totalAmount = $amount * $seatsBooked; // - montant total à créditer/débiter
        
        // Crediter le conducteur
        $this->creditDriver($driver, $totalAmount);

        // Debiter le passager
        $this->debitPassenger($passenger, $totalAmount);

        // Persister les changements dans la base de données
        $this->entityManager->flush();
    }

    // Crediter conducteur
    private function creditDriver(User $driver, int $amount)
    {
        $newSolde = $driver->getSolde() + $amount;
        $driver->setSolde($newSolde);
        $this->entityManager->persist($driver);
    }

    // Debiter passager
    private function debitPassenger(User $passenger, int $amount)
    {
        $newSolde = $passenger->getSolde() - $amount;
        if ($newSolde < 0) {
            throw new \Exception("Le passager n'a pas assez de crédits pour effectuer cette réservation.");
        }
        $passenger->setSolde($newSolde);
        $this->entityManager->persist($passenger);
    }
}
