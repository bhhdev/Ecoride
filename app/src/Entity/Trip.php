<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Trip
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private \DateTime $departureDay;

    #[ORM\Column]
    private \DateTime $arrivalDay;

    #[ORM\Column]
    private int $numberSeats;

    #[ORM\Column]
    private int $seatAvailable;

    #[ORM\ManyToOne(inversedBy: 'trips')]
    #[ORM\JoinColumn(nullable: false)]
    private User $user;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private Vehicle $vehicle;

    #[ORM\OneToOne(cascade: ['persist'], inversedBy: 'trip')]
    #[ORM\JoinColumn(nullable: false)]
    private Preference $preference;

    #[ORM\OneToMany(mappedBy: 'trip', targetEntity: Booking::class)]
    private Collection $bookings;

    public function __construct()
    {
        $this->bookings = new ArrayCollection();
        $this->numberSeats = rand(1, 4);
        $this->seatAvailable = $this->numberSeats;
        $this->departureDay = new \DateTime('+1 day');
        $this->arrivalDay = (clone $this->departureDay)->modify('+2 hours');
    }

    public function getId(): ?int { return $this->id; }
    public function getUser(): User { return $this->user; }
    public function setUser(User $u): self { $this->user = $u; return $this; }
    public function getVehicle(): Vehicle { return $this->vehicle; }
    public function setVehicle(Vehicle $v): self { $this->vehicle = $v; return $this; }
    public function getPreference(): Preference { return $this->preference; }
    public function setPreference(Preference $p): self { $this->preference = $p; $p->setTrip($this); return $this; }
    public function getNumberSeats(): int { return $this->numberSeats; }
    public function getSeatAvailable(): int { return $this->seatAvailable; }
    public function decrementSeat(): void { if ($this->seatAvailable > 0) $this->seatAvailable--; }
}
