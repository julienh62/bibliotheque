<?php

namespace App\Entity;

use App\Repository\DvdRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DvdRepository::class)]
final class Dvd extends Document
{


    #[ORM\Column]
    private ?\DateTimeImmutable $duration = null;

    #[ORM\Column(length: 80)]
    private ?string $tracks = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDuration(): ?\DateTimeImmutable
    {
        return $this->duration;
    }

    public function setDuration(\DateTimeImmutable $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    public function getTracks(): ?string
    {
        return $this->tracks;
    }

    public function setTracks(string $tracks): self
    {
        $this->tracks = $tracks;

        return $this;
    }
}
