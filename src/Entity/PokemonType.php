<?php

namespace App\Entity;

use App\Repository\PokemonTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PokemonTypeRepository::class)
 */
class PokemonType
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $nom;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $evolution;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $starter;

    /**
     * @ORM\Column(type="string", length=3, nullable=true)
     */
    private $typeCourbeNiveau;

    /**
     * @ORM\ManyToOne(targetEntity=ElementaryType::class, inversedBy="pokemonEspece1")
     */
    private $type1;

    /**
     * @ORM\ManyToOne(targetEntity=ElementaryType::class, inversedBy="pokemonEspece2")
     */
    private $type2;

    /**
     * @ORM\OneToMany(targetEntity=Pokemon::class, mappedBy="typePokemon")
     */
    private $pokemonIndividu;

    public function __construct()
    {
        $this->pokemonIndividu = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getEvolution(): ?bool
    {
        return $this->evolution;
    }

    public function setEvolution(?bool $evolution): self
    {
        $this->evolution = $evolution;

        return $this;
    }

    public function getStarter(): ?bool
    {
        return $this->starter;
    }

    public function setStarter(?bool $starter): self
    {
        $this->starter = $starter;

        return $this;
    }

    public function getTypeCourbeNiveau(): ?string
    {
        return $this->typeCourbeNiveau;
    }

    public function setTypeCourbeNiveau(?string $typeCourbeNiveau): self
    {
        $this->typeCourbeNiveau = $typeCourbeNiveau;

        return $this;
    }

    public function getType1(): ?ElementaryType
    {
        return $this->type1;
    }

    public function setType1(?ElementaryType $type1): self
    {
        $this->type1 = $type1;

        return $this;
    }

    public function getType2(): ?ElementaryType
    {
        return $this->type2;
    }

    public function setType2(?ElementaryType $type2): self
    {
        $this->type2 = $type2;

        return $this;
    }

    /**
     * @return Collection|Pokemon[]
     */
    public function getPokemonIndividu(): Collection
    {
        return $this->pokemonIndividu;
    }

    public function addPokemonIndividu(Pokemon $pokemonIndividu): self
    {
        if (!$this->pokemonIndividu->contains($pokemonIndividu)) {
            $this->pokemonIndividu[] = $pokemonIndividu;
            $pokemonIndividu->setTypePokemon($this);
        }

        return $this;
    }

    public function removePokemonIndividu(Pokemon $pokemonIndividu): self
    {
        if ($this->pokemonIndividu->contains($pokemonIndividu)) {
            $this->pokemonIndividu->removeElement($pokemonIndividu);
            // set the owning side to null (unless already changed)
            if ($pokemonIndividu->getTypePokemon() === $this) {
                $pokemonIndividu->setTypePokemon(null);
            }
        }

        return $this;
    }
}
