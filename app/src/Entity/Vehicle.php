<?php

namespace App\Entity;

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
    private int $seats;

    #[ORM\ManyToOne(inversedBy: 'vehicles')]
    #[ORM\JoinColumn(nullable: false)]
    private User $owner;

    public function getId(): ?int { return $this->id; }
    public function getBrand(): string { return $this->brand; }
    public function setBrand(string $b): self { $this->brand = $b; return $this; }
    public function getModel(): string { return $this->model; }
    public function setModel(string $m): self { $this->model = $m; return $this; }
    public function getSeats(): int { return $this->seats; }
    public function setSeats(int $s): self { $this->seats = $s; return $this; }
    public function getOwner(): User { return $this->owner; }
    public function setOwner(User $u): self { $this->owner = $u; return $this; }
}
