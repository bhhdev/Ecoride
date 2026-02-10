<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Notice
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private int $mark;

    #[ORM\Column(type: 'text')]
    private string $comment;

    #[ORM\Column]
    private bool $isComplaint;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private User $author;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private User $target;

    #[ORM\OneToOne]
    #[ORM\JoinColumn(nullable: false)]
    private Booking $booking;

    public function __construct(
        int $mark,
        string $comment,
        User $author,
        User $target,
        Booking $booking
    ) {
        if ($mark < 1 || $mark > 5) {
            throw new \InvalidArgumentException('Mark must be between 1 and 5.');
        }

        if ($mark < 3 && trim($comment) === '') {
            throw new \LogicException('Low marks must have a comment.');
        }

        $this->mark = $mark;
        $this->comment = $comment;
        $this->author = $author;
        $this->target = $target;
        $this->booking = $booking;
        $this->isComplaint = $mark < 3;
    }

    // --- Getters & Setters ---
    public function getId(): ?int { return $this->id; }

    public function getMark(): int { return $this->mark; }
    public function setMark(int $mark): self { 
        if ($mark < 1 || $mark > 5) throw new \InvalidArgumentException();
        $this->mark = $mark; 
        $this->isComplaint = $mark < 3;
        return $this;
    }

    public function getComment(): string { return $this->comment; }
    public function setComment(string $comment): self { $this->comment = $comment; return $this; }

    public function getIsComplaint(): bool { return $this->isComplaint; }
    public function setIsComplaint(bool $isComplaint): self { $this->isComplaint = $isComplaint; return $this; }

    public function getAuthor(): User { return $this->author; }
    public function setAuthor(User $author): self { $this->author = $author; return $this; }

    public function getTarget(): User { return $this->target; }
    public function setTarget(User $target): self { $this->target = $target; return $this; }

    public function getBooking(): Booking { return $this->booking; }
    public function setBooking(Booking $booking): self { $this->booking = $booking; return $this; }
}
