<?php

namespace App\Entity;

use App\Repository\DocumentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\InheritanceType("JOINED")]
#[ORM\DiscriminatorColumn(name:"documentType", type:"string")]
//#[ORM\DiscriminatorMap({"DOO":"Document", "L01":"Book", "D02":"Cd"})]
#[ORM\Entity(repositoryClass: DocumentRepository::class)]
class Document
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    protected ?int $id = null;

    #[ORM\Column(length: 50)]
    protected ?string $cote = null;

//    #[ORM\Column]
//    protected ?\DateTimeImmutable $name = null;
    #[ORM\Column(length: 80)]
    private ?string $name = null;

    #[ORM\Column]
    protected ?bool $type = null;

    #[ORM\Column]
    protected ?bool $avalaible = null;

    #[ORM\Column]
    protected ?bool $borrowable = null;

    #[ORM\Column(type: Types::TEXT)]
    protected ?string $description = null;

    #[ORM\ManyToMany(targetEntity: Autor::class, mappedBy: 'documentsAutor')]
    protected Collection $autors;

    #[ORM\OneToMany(mappedBy: 'document', targetEntity: Borrow::class)]
    private Collection $DocumentBorrow;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    public function __construct()
    {
        $this->autors = new ArrayCollection();
        $this->DocumentBorrow = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCote(): ?string
    {
        return $this->cote;
    }

    public function setCote(string $cote): self
    {
        $this->cote = $cote;

        return $this;
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

    public function isType(): ?bool
    {
        return $this->type;
    }

    public function setType(bool $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function isAvalaible(): ?bool
    {
        return $this->avalaible;
    }

    public function setAvalaible(bool $avalaible): self
    {
        $this->avalaible = $avalaible;

        return $this;
    }


    public function isBorrowable(): ?bool
    {
        return $this->borrowable;
    }

    public function setBorrowable(bool $borrowable): self
    {
        $this->borrowable = $borrowable;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, Autor>
     */
    public function getAutors(): Collection
    {
        return $this->autors;
    }

    public function addAutor(Autor $autor): self
    {
        if (!$this->autors->contains($autor)) {
            $this->autors->add($autor);
            $autor->addDocumentsAutor($this);
        }

        return $this;
    }

    public function removeAutor(Autor $autor): self
    {
        if ($this->autors->removeElement($autor)) {
            $autor->removeDocumentsAutor($this);
        }

        return $this;
    }


    /**
     * @return Collection<int, Borrow>
     */
    public function getDocumentBorrow(): Collection
    {
        return $this->DocumentBorrow;
    }

    public function addDocumentBorrow(Borrow $documentBorrow): self
    {
        if (!$this->DocumentBorrow->contains($documentBorrow)) {
            $this->DocumentBorrow->add($documentBorrow);
            $documentBorrow->setDocument($this);
        }

        return $this;
    }

    public function removeDocumentBorrow(Borrow $documentBorrow): self
    {
        if ($this->DocumentBorrow->removeElement($documentBorrow)) {
            // set the owning side to null (unless already changed)
            if ($documentBorrow->getDocument() === $this) {
                $documentBorrow->setDocument(null);
            }
        }

        return $this;
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
}
