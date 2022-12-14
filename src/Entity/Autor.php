<?php

namespace App\Entity;

use App\Repository\AutorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: AutorRepository::class)]
class Autor
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    #[Assert\Length(
        min: 2,
        max: 50,
        minMessage: 'Your first name must be at least {{ limit }} characters long',
        maxMessage: 'Your first name cannot be longer than {{ limit }} characters',
    )]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $bio = null;

    #[ORM\ManyToMany(targetEntity: Document::class, inversedBy: 'autors')]
    private Collection $documentsAutor;

    #[ORM\Column]
    private ?\DateTime $birth = null;

    public function __construct()
    {
        $this->documentsAutor = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->name;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getBio(): ?string
    {
        return $this->bio;
    }

    public function setBio(string $bio): self
    {
        $this->bio = $bio;

        return $this;
    }

    /**
     * @return Collection<int, Document>
     */
    public function getDocumentsAutor(): Collection
    {
        return $this->documentsAutor;
    }

    public function addDocumentsAutor(Document $documentsAutor): self
    {
        if (!$this->documentsAutor->contains($documentsAutor)) {
            $this->documentsAutor->add($documentsAutor);
        }

        return $this;
    }

    public function removeDocumentsAutor(Document $documentsAutor): self
    {
        $this->documentsAutor->removeElement($documentsAutor);

        return $this;
    }

    public function getBirth(): ?\DateTime
    {
        return $this->birth;
    }

    public function setBirth(\DateTime $birth): self
    {
        $this->birth = $birth;

        return $this;
    }
}
