<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Booking
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private User $user;

    #[ORM\ManyToOne(inversedBy: 'bookings')]
    #[ORM\JoinColumn(nullable: false)]
    private Trip $trip;

    #[ORM\Column]
    private int $seatNumber;

    public function getId(): ?int { return $this->id; }
    public function getUser(): User { return $this->user; }
    public function setUser(User $u): self { $this->user = $u; return $this; }
    public function getTrip(): Trip { return $this->trip; }
    public function setTrip(Trip $t): self { $this->trip = $t; return $this; }
    public function getSeatNumber(): int { return $this->seatNumber; }
    public function setSeatNumber(int $n): self { $this->seatNumber = $n; return $this; }
}
