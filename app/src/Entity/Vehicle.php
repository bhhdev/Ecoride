<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Vehicle
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private string $brand;

    #[ORM\Column(length: 50)]
    private string $model;

    #[ORM\Column]
    private int $numberSeats;

    #[ORM\Column(length: 20)]
    private string $energy;

    #[ORM\ManyToOne(inversedBy: 'vehicles')]
    #[ORM\JoinColumn(nullable: false)]
    private User $owner;

    #[ORM\OneToMany(mappedBy: 'vehicle', targetEntity: Trip::class)]
    private Collection $trips;

    public function __construct()
    {
        $this->trips = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBrand(): string
    {
        return $this->brand;
    }

    public function setBrand(
        string $brand
    ): self
    {
        $this->brand = $brand;
        return $this;
    }

    public function getModel(): string
    {
        return $this->model;
    }

    public function setModel(
        string $model
    ): self
    {
        $this->model = $model;
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
        $this->numberSeats = $numberSeats;
        return $this;
    }

    public function getEnergy(): string
    {
        return $this->energy;
    }

    public function setEnergy(
        string $energy
    ): self
    {
        $this->energy = $energy;
        return $this;
    }

    public function getOwner(): User
    {
        return $this->owner;
    }

    public function setOwner(
        User $owner
    ): self
    {
        $this->owner = $owner;
        return $this;
    }

    public function getTrips(): Collection
    {
        return $this->trips;
    }
}
