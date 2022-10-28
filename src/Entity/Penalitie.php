<?php

namespace App\Entity;

use App\Repository\PenalitieRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PenalitieRepository::class)]
class Penalitie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?bool $type = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Borrow $Borrowspenalitie = null;

    #[ORM\ManyToOne(inversedBy: 'UserPenalitie')]
    private ?User $user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function isType(): ?bool
    {
        return $this->type;
    }

    public function setType(bool $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getBorrowspenalitie(): ?Borrow
    {
        return $this->Borrowspenalitie;
    }

    public function setBorrowspenalitie(?Borrow $Borrowspenalitie): self
    {
        $this->Borrowspenalitie = $Borrowspenalitie;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
