<?php

namespace App\Entity;

use App\Repository\TripRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TripRepository::class)]
class Trip
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(type: 'date_immutable')]
    private \DateTimeImmutable $departureDay;

    #[ORM\Column(type: 'time_immutable')]
    private \DateTimeImmutable $departureHour;

    #[ORM\Column(type: 'date_immutable')]
    private \DateTimeImmutable $arrivalDay;

    #[ORM\Column(type: 'time_immutable')]
    private \DateTimeImmutable $arrivalHour;

    #[ORM\Column(length: 50)]
    private string $departureAddress;

    #[ORM\Column(length: 50)]
    private string $departureCity;

    #[ORM\Column(length: 50)]
    private string $arrivalAddress;

    #[ORM\Column(length: 50)]
    private string $arrivalCity;

    #[ORM\Column]
    private int $seatPrice;

    #[ORM\Column]
    private int $numberSeats;

    #[ORM\Column]
    private int $seatAvailable;

    #[ORM\Column(length: 20)]
    private string $status;

    #[ORM\Column]
    private \DateTimeImmutable $createdAt;

    #[ORM\Column]
    private \DateTimeImmutable $updatedAt;

    #[ORM\ManyToOne(inversedBy: 'trips')]
    #[ORM\JoinColumn(nullable: false)]
    private User $user;

    #[ORM\OneToOne(inversedBy: 'trip', cascade: ['persist'])]
    #[ORM\JoinColumn(nullable: false)]
    private Preference $preference;

    #[ORM\ManyToOne(inversedBy: 'trips')]
    #[ORM\JoinColumn(nullable: false)]
    private Vehicle $vehicle;

    #[ORM\OneToMany(mappedBy: 'trip', targetEntity: Booking::class)]
    private Collection $bookings;

    public function __construct()
    {
        $now = new \DateTimeImmutable();

        $this->departureDay = $now;
        $this->departureHour = $now;

        $this->arrivalDay = $now->modify('+1 hour');
        $this->arrivalHour = $now->modify('+1 hour');

        $this->departureAddress = '';
        $this->departureCity = '';
        $this->arrivalAddress = '';
        $this->arrivalCity = '';

        $this->seatPrice = 0;
        $this->numberSeats = 1;
        $this->seatAvailable = 1;
        $this->status = 'scheduled';

        $this->createdAt = $now;
        $this->updatedAt = $now;

        $this->bookings = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(
        User $user
    ): self
    {
        $this->user = $user;
        return $this;
    }

    public function getVehicle(): Vehicle
    {
        return $this->vehicle;
    }

    public function setVehicle(
        Vehicle $vehicle
    ): self
    {
        $this->vehicle = $vehicle;
        return $this;
    }

    public function getPreference(): Preference
    {
        return $this->preference;
    }

    public function setPreference(
        Preference $preference
    ): self
    {
        $this->preference = $preference;
        return $this;
    }

    public function getBookings(): Collection
    {
        return $this->bookings;
    }

    public function getDepartureCity(): string
    {
        return $this->departureCity;
    }

    public function setDepartureCity(
        string $city
    ): self
    {
        $this->departureCity = $city;
        return $this;
    }

    public function getArrivalCity(): string
    {
        return $this->arrivalCity;
    }

    public function setArrivalCity(
        string $city
    ): self
    {
        $this->arrivalCity = $city;
        return $this;
    }

    public function getDepartureDay(): \DateTimeImmutable
    {
        return $this->departureDay;
    }

    public function setDepartureDay(
        \DateTimeImmutable $date
    ): self
    {
        $this->departureDay = $date;
        return $this;
    }

    public function getDepartureHour(): \DateTimeImmutable
    {
        return $this->departureHour;
    }

    public function setDepartureHour(
        \DateTimeImmutable $hour
    ): self
    {
        $this->departureHour = $hour;
        return $this;
    }

    public function getArrivalDay(): \DateTimeImmutable
    {
        return $this->arrivalDay;
    }

    public function setArrivalDay(
        \DateTimeImmutable $date
    ): self
    {
        $this->arrivalDay = $date;
        return $this;
    }

    public function getArrivalHour(): \DateTimeImmutable
    {
        return $this->arrivalHour;
    }

    public function setArrivalHour(
        \DateTimeImmutable $hour
    ): self
    {
        $this->arrivalHour = $hour;
        return $this;
    }

    public function getSeatAvailable(): int
    {
        return $this->seatAvailable;
    }

    /**
     * Setter nécessaire pour que le formulaire Symfony puisse hydrater l'entité
     */
    public function setSeatAvailable(
        int $seatAvailable
    ): self
    {
        $this->seatAvailable = $seatAvailable;

        return $this;
    }

    public function getSeatPrice(): int
    {
        return $this->seatPrice;
    }

    public function setSeatPrice(
        int $price
    ): self
    {
        $this->seatPrice = $price;
        return $this;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(
        string $status
    ): self
    {
        $this->status = $status;
        return $this;
    }

    public function getNumberSeats(): int
    {
        return $this->numberSeats;
    }

    public function setNumberSeats(
        int $numberSeats
    ): self
    {
        if (isset($this->vehicle)) {
            $maxSeats = $this->vehicle->getNumberSeats();
            if ($numberSeats > $maxSeats) {
                throw new \DomainException(
                    "Le véhicule autorise maximum $maxSeats passagers."
                );
            }
        }

        $this->numberSeats = $numberSeats;
        $this->seatAvailable = $numberSeats;

        return $this;
    }

    public function decrementSeatAvailable(): self
    {
        if ($this->seatAvailable <= 0) {
            throw new \DomainException("Plus aucune place disponible.");
        }

        $this->seatAvailable--;

        return $this;
    }

    public function setUpdatedAt(
        \DateTimeImmutable $date
    ): self
    {
        $this->updatedAt = $date;

        return $this;
    }

    public function getDepartureAddress(): string
    {
        return $this->departureAddress;
    }

    public function setDepartureAddress(
        string $address
    ): self
    {
        $this->departureAddress = $address;

        return $this;
    }

    public function getArrivalAddress(): string
    {
        return $this->arrivalAddress;
    }

    public function setArrivalAddress(
        string $address
    ): self
    {
        $this->arrivalAddress = $address;

        return $this;
    }

    // ===============================
    // Utilitaire pour le front
    // ===============================

    public function isEco(): bool
    {
        return $this->vehicle->getEnergy() === 'electric';
    }
}