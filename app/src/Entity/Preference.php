<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Preference
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private bool $airConditioning = false;

    #[ORM\Column]
    private bool $animalsAccepted = false;

    #[ORM\Column]
    private bool $smokeVap = false;

    #[ORM\OneToOne(mappedBy: 'preference', targetEntity: Trip::class, cascade: ['persist'])]
    private ?Trip $trip = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAirConditioning(): bool
    {
        return $this->airConditioning;
    }

    public function setAirConditioning(bool $value): self
    {
        $this->airConditioning = $value;

        return $this;
    }

    public function getAnimalsAccepted(): bool
    {
        return $this->animalsAccepted;
    }

    public function setAnimalsAccepted(bool $value): self
    {
        $this->animalsAccepted = $value;

        return $this;
    }

    public function getSmokeVap(): bool
    {
        return $this->smokeVap;
    }

    public function setSmokeVap(bool $value): self
    {
        $this->smokeVap = $value;

        return $this;
    }

    public function getTrip(): ?Trip
    {
        return $this->trip;
    }

    public function setTrip(Trip $trip): self
    {
        $this->trip = $trip;

        return $this;
    }
}