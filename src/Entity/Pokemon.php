<?php

namespace App\Entity;

use App\Repository\PokemonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PokemonRepository::class)
 */
class Pokemon
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=PokemonType::class, inversedBy="pokemonIndividu")
     */
    private $typePokemon;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="pokemonEnpossession")
     */
    private $dresseur;

    /**
     * @ORM\Column(type="string", length=2, nullable=true)
     */
    private $sexe;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $surnom;

    /**
     * @return mixed
     */
    public function getSurnom()
    {
        return $this->surnom;
    }

    /**
     * @param mixed $surnom
     */
    public function setSurnom($surnom): void
    {
        $this->surnom = $surnom;
    }

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $xp;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $niveau;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $aVendre;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $prix;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateDernierEntrainement;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateDerniereChasse;

    /**
     * @ORM\OneToMany(targetEntity=Chasse::class, mappedBy="pokemon")
     */
    private $chasses;

    /**
     * @ORM\OneToMany(targetEntity=Chasse::class, mappedBy="pokemonChasse")
     */
    private $aEteChasse;

    public function __construct()
    {
        $this->chasses = new ArrayCollection();
        $this->aEteChasse = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypePokemon(): ?PokemonType
    {
        return $this->typePokemon;
    }

    public function setTypePokemon(?PokemonType $typePokemon): self
    {
        $this->typePokemon = $typePokemon;

        return $this;
    }

    public function getDresseur(): ?User
    {
        return $this->dresseur;
    }

    public function setDresseur(?User $dresseur): self
    {
        $this->dresseur = $dresseur;

        return $this;
    }

    public function getSexe(): ?string
    {
        return $this->sexe;
    }

    public function setSexe(?string $sexe): self
    {
        $this->sexe = $sexe;

        return $this;
    }

    public function getXp(): ?float
    {
        return $this->xp;
    }

    public function setXp(?float $xp): self
    {
        $this->xp = $xp;

        return $this;
    }

    public function getNiveau(): ?int
    {
        return $this->niveau;
    }

    public function setNiveau(?int $niveau): self
    {
        $this->niveau = $niveau;

        return $this;
    }

    public function getAVendre(): ?bool
    {
        return $this->aVendre;
    }

    public function setAVendre(?bool $aVendre): self
    {
        $this->aVendre = $aVendre;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(?float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDateDernierEntrainement()
    {
        return $this->dateDernierEntrainement;
    }

    /**
     * @param mixed $dateDernierEntrainement
     */
    public function setDateDernierEntrainement($dateDernierEntrainement): void
    {
        $this->dateDernierEntrainement = $dateDernierEntrainement;
    }

    /**
     * @return mixed
     */
    public function getDateDerniereChasse()
    {
        return $this->dateDerniereChasse;
    }

    /**
     * @param mixed $dateDerniereChasse
     */
    public function setDateDerniereChasse($dateDerniereChasse): void
    {
        $this->dateDerniereChasse = $dateDerniereChasse;
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
            $chass->setPokemon($this);
        }

        return $this;
    }

    public function removeChass(Chasse $chass): self
    {
        if ($this->chasses->contains($chass)) {
            $this->chasses->removeElement($chass);
            // set the owning side to null (unless already changed)
            if ($chass->getPokemon() === $this) {
                $chass->setPokemon(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Chasse[]
     */
    public function getAEteChasse(): Collection
    {
        return $this->aEteChasse;
    }

    public function addAEteChasse(Chasse $aEteChasse): self
    {
        if (!$this->aEteChasse->contains($aEteChasse)) {
            $this->aEteChasse[] = $aEteChasse;
            $aEteChasse->setPokemonChasse($this);
        }

        return $this;
    }

    public function removeAEteChasse(Chasse $aEteChasse): self
    {
        if ($this->aEteChasse->contains($aEteChasse)) {
            $this->aEteChasse->removeElement($aEteChasse);
            // set the owning side to null (unless already changed)
            if ($aEteChasse->getPokemonChasse() === $this) {
                $aEteChasse->setPokemonChasse(null);
            }
        }

        return $this;
    }


}
