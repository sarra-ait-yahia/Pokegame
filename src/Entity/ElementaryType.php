<?php

namespace App\Entity;

use App\Repository\ElementaryTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ElementaryTypeRepository::class)
 */
class ElementaryType
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
    private $libelle;

    /**
     * @ORM\OneToMany(targetEntity=PokemonType::class, mappedBy="type1")
     */
    private $pokemonEspece1;

    /**
     * @ORM\OneToMany(targetEntity=PokemonType::class, mappedBy="type2")
     */
    private $pokemonEspece2;

    /**
     * @ORM\ManyToMany(targetEntity=CaptureLieu::class, mappedBy="PokemonEspece")
     */
    private $LieuDeCapture;

    public function __construct()
    {
        $this->pokemonEspece1 = new ArrayCollection();
        $this->pokemonEspece2 = new ArrayCollection();
        $this->LieuDeCapture = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(?string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * @return Collection|PokemonType[]
     */
    public function getPokemonEspece1(): Collection
    {
        return $this->pokemonEspece1;
    }

    public function addPokemonEspece1(PokemonType $pokemonEspece1): self
    {
        if (!$this->pokemonEspece1->contains($pokemonEspece1)) {
            $this->pokemonEspece1[] = $pokemonEspece1;
            $pokemonEspece1->setType1($this);
        }

        return $this;
    }

    public function removePokemonEspece1(PokemonType $pokemonEspece1): self
    {
        if ($this->pokemonEspece1->contains($pokemonEspece1)) {
            $this->pokemonEspece1->removeElement($pokemonEspece1);
            // set the owning side to null (unless already changed)
            if ($pokemonEspece1->getType1() === $this) {
                $pokemonEspece1->setType1(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|PokemonType[]
     */
    public function getPokemonEspece2(): Collection
    {
        return $this->pokemonEspece2;
    }

    public function addPokemonEspece2(PokemonType $pokemonEspece2): self
    {
        if (!$this->pokemonEspece2->contains($pokemonEspece2)) {
            $this->pokemonEspece2[] = $pokemonEspece2;
            $pokemonEspece2->setType2($this);
        }

        return $this;
    }

    public function removePokemonEspece2(PokemonType $pokemonEspece2): self
    {
        if ($this->pokemonEspece2->contains($pokemonEspece2)) {
            $this->pokemonEspece2->removeElement($pokemonEspece2);
            // set the owning side to null (unless already changed)
            if ($pokemonEspece2->getType2() === $this) {
                $pokemonEspece2->setType2(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|CaptureLieu[]
     */
    public function getLieuDeCapture(): Collection
    {
        return $this->LieuDeCapture;
    }

    public function addLieuDeCapture(CaptureLieu $lieuDeCapture): self
    {
        if (!$this->LieuDeCapture->contains($lieuDeCapture)) {
            $this->LieuDeCapture[] = $lieuDeCapture;
            $lieuDeCapture->addPokemonEspece($this);
        }

        return $this;
    }

    public function removeLieuDeCapture(CaptureLieu $lieuDeCapture): self
    {
        if ($this->LieuDeCapture->contains($lieuDeCapture)) {
            $this->LieuDeCapture->removeElement($lieuDeCapture);
            $lieuDeCapture->removePokemonEspece($this);
        }

        return $this;
    }
}
