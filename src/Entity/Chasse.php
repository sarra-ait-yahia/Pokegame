<?php

namespace App\Entity;

use App\Repository\ChasseRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ChasseRepository::class)
 */
class Chasse
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="chasses")
     */
    private $dresseur;

    /**
     * @ORM\ManyToOne(targetEntity=CaptureLieu::class, inversedBy="chasses")
     */
    private $lieuCapture;

    /**
     * @ORM\ManyToOne(targetEntity=Pokemon::class, inversedBy="chasses")
     */
    private $pokemon;

    /**
     * @ORM\ManyToOne(targetEntity=Pokemon::class, inversedBy="aEteChasse")
     */
    private $pokemonChasse;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateChasse;

    /**
     * @return mixed
     */
    public function getDateChasse()
    {
        return $this->dateChasse;
    }

    /**
     * @param mixed $dateChasse
     */
    public function setDateChasse($dateChasse): void
    {
        $this->dateChasse = $dateChasse;
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getLieuCapture(): ?CaptureLieu
    {
        return $this->lieuCapture;
    }

    public function setLieuCapture(?CaptureLieu $lieuCapture): self
    {
        $this->lieuCapture = $lieuCapture;

        return $this;
    }

    public function getPokemon(): ?pokemon
    {
        return $this->pokemon;
    }

    public function setPokemon(?pokemon $pokemon): self
    {
        $this->pokemon = $pokemon;

        return $this;
    }

    public function getPokemonChasse(): ?pokemon
    {
        return $this->pokemonChasse;
    }

    public function setPokemonChasse(?pokemon $pokemonChasse): self
    {
        $this->pokemonChasse = $pokemonChasse;

        return $this;
    }
}
