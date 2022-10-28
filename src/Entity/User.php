<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 80)]
    private ?string $lastName = null;

    #[ORM\Column(length: 50)]
    private ?string $firstName = null;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Penalitie::class)]
    private Collection $UserPenalitie;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Subscription::class)]
    private Collection $UserSuscription;

    public function __construct()
    {
        $this->UserPenalitie = new ArrayCollection();
        $this->UserSuscription = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * @return Collection<int, Penalitie>
     */
    public function getUserPenalitie(): Collection
    {
        return $this->UserPenalitie;
    }

    public function addUserPenalitie(Penalitie $userPenalitie): self
    {
        if (!$this->UserPenalitie->contains($userPenalitie)) {
            $this->UserPenalitie->add($userPenalitie);
            $userPenalitie->setUser($this);
        }

        return $this;
    }

    public function removeUserPenalitie(Penalitie $userPenalitie): self
    {
        if ($this->UserPenalitie->removeElement($userPenalitie)) {
            // set the owning side to null (unless already changed)
            if ($userPenalitie->getUser() === $this) {
                $userPenalitie->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Subscription>
     */
    public function getUserSuscription(): Collection
    {
        return $this->UserSuscription;
    }

    public function addUserSuscription(Subscription $userSuscription): self
    {
        if (!$this->UserSuscription->contains($userSuscription)) {
            $this->UserSuscription->add($userSuscription);
            $userSuscription->setUser($this);
        }

        return $this;
    }

    public function removeUserSuscription(Subscription $userSuscription): self
    {
        if ($this->UserSuscription->removeElement($userSuscription)) {
            // set the owning side to null (unless already changed)
            if ($userSuscription->getUser() === $this) {
                $userSuscription->setUser(null);
            }
        }

        return $this;
    }
}
