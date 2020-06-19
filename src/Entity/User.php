<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity(fields={"username"}, message="Un compte dresseur existe déjà avec ce pseudo")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $username;

    /**
     * @ORM\Column(type="json",nullable=true))
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @var string (type="string", unique=true)
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $mail;

    /**
     * @return string
     */
    public function getMail(): ?string
    {
        return $this->mail;
    }

    /**
     * @param string $mail
     */
    public function setMail(?string $mail): void
    {
        $this->mail = $mail;
    }

    /**
     * @return int
     */
    public function getNbPiece(): ?int
    {
        return $this->nbPiece;
    }

    /**
     * @param int $nbPiece
     */
    public function setNbPiece(?int $nbPiece): void
    {
        $this->nbPiece = $nbPiece;
    }

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $pokemonOffert;

    /**
     * @return mixed
     */
    public function getPokemonOffert()
    {
        return $this->pokemonOffert;
    }

    /**
     * @param mixed $pokemonOffert
     */
    public function setPokemonOffert($pokemonOffert): void
    {
        $this->pokemonOffert = $pokemonOffert;
    }

    /**
     * @var integer
     * @ORM\Column(type="integer", length=50, nullable=true)
     */
    private $nbPiece;

    /**
     * @ORM\OneToMany(targetEntity=Pokemon::class, mappedBy="dresseur")
     */
    private $pokemonEnpossession;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isVerified = false;

    /**
     * @ORM\OneToMany(targetEntity=Chasse::class, mappedBy="dresseur")
     */
    private $chasses;

    public function __construct()
    {
        $this->pokemonEnpossession = new ArrayCollection();
        $this->chasses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
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
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @return Collection|Pokemon[]
     */
    public function getPokemonEnpossession(): Collection
    {
        return $this->pokemonEnpossession;
    }

    public function addPokemonEnpossession(Pokemon $pokemonEnpossession): self
    {
        if (!$this->pokemonEnpossession->contains($pokemonEnpossession)) {
            $this->pokemonEnpossession[] = $pokemonEnpossession;
            $pokemonEnpossession->setDresseur($this);
        }

        return $this;
    }

    public function removePokemonEnpossession(Pokemon $pokemonEnpossession): self
    {
        if ($this->pokemonEnpossession->contains($pokemonEnpossession)) {
            $this->pokemonEnpossession->removeElement($pokemonEnpossession);
            // set the owning side to null (unless already changed)
            if ($pokemonEnpossession->getDresseur() === $this) {
                $pokemonEnpossession->setDresseur(null);
            }
        }

        return $this;
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): self
    {
        $this->isVerified = $isVerified;

        return $this;
    }

    public function getIsVerified(): ?bool
    {
        return $this->isVerified;
    }

    /**
     * @return Collection|Chasse[]
     */
    public function getChasses(): Collection
    {
        return $this->chasses;
    }

    public function addChass(Chasse $chass): self
    {
        if (!$this->chasses->contains($chass)) {
            $this->chasses[] = $chass;
            $chass->setDresseur($this);
        }

        return $this;
    }

    public function removeChass(Chasse $chass): self
    {
        if ($this->chasses->contains($chass)) {
            $this->chasses->removeElement($chass);
            // set the owning side to null (unless already changed)
            if ($chass->getDresseur() === $this) {
                $chass->setDresseur(null);
            }
        }

        return $this;
    }
}
