<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

#[ORM\Entity]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private string $email;

    #[ORM\Column]
    private string $password;

    #[ORM\Column(type: 'json')]
    private array $roles = [];

    #[ORM\Column(length: 50)]
    private string $firstname;

    #[ORM\Column(length: 50)]
    private string $lastname;

    #[ORM\Column(length: 10)]
    private string $phone;

    #[ORM\Column]
    private int $credits = 0;

    #[ORM\Column]
    private bool $isPassenger = true;

    #[ORM\Column]
    private bool $isDriver = false;

    #[ORM\Column]
    private \DateTimeImmutable $createdAt;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Trip::class)]
    private Collection $trips;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Booking::class)]
    private Collection $bookings;

    #[ORM\OneToMany(mappedBy: 'owner', targetEntity: Vehicle::class)]
    private Collection $vehicles;

    public function __construct()
    {
        $this->trips = new ArrayCollection();
        $this->bookings = new ArrayCollection();
        $this->vehicles = new ArrayCollection();
        $this->createdAt = new \DateTimeImmutable();
        $this->credits = rand(0, 1000);
    }

    public function getId(): ?int { return $this->id; }

    public function getEmail(): string { return $this->email; }
    public function setEmail(string $email): self { $this->email = $email; return $this; }

    public function getFirstname(): string { return $this->firstname; }
    public function setFirstname(string $f): self { $this->firstname = $f; return $this; }

    public function getLastname(): string { return $this->lastname; }
    public function setLastname(string $l): self { $this->lastname = $l; return $this; }

    public function getPhone(): string { return $this->phone; }
    public function setPhone(string $p): self { $this->phone = $p; return $this; }

    public function getCredits(): int { return $this->credits; }
    public function setCredits(int $c): self { $this->credits = $c; return $this; }

    public function getIsPassenger(): bool { return $this->isPassenger; }
    public function setIsPassenger(bool $b): self { $this->isPassenger = $b; return $this; }

    public function getIsDriver(): bool { return $this->isDriver; }
    public function setIsDriver(bool $b): self { $this->isDriver = $b; return $this; }

    public function getUserIdentifier(): string { return $this->email; }
    public function getRoles(): array { $roles = $this->roles; $roles[] = 'ROLE_CLIENT'; return array_unique($roles); }
    public function getPassword(): string { return $this->password; }
    public function setPassword(string $password): self { $this->password = $password; return $this; }
    public function eraseCredentials(): void {}

    public function addVehicle(Vehicle $v): self {
        if (!$this->vehicles->contains($v)) {
            $this->vehicles->add($v);
            $v->setOwner($this);
            $this->isDriver = true;
        }
        return $this;
    }
}
