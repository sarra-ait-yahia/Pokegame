<?php

namespace App\Entity;

use App\Repository\CaptureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CaptureRepository::class)
 */
class CaptureLieu
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
    private $Lieu;

    /**
     * @ORM\ManyToMany(targetEntity=ElementaryType::class, inversedBy="LieuDeCapture")
     */
    private $PokemonEspece;

    /**
     * @ORM\OneToMany(targetEntity=Chasse::class, mappedBy="lieuCapture")
     */
    private $chasses;

    public function __construct()
    {
        $this->PokemonEspece = new ArrayCollection();
        $this->chasses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLieu(): ?string
    {
        return $this->Lieu;
    }

    public function setLieu(?string $Lieu): self
    {
        $this->Lieu = $Lieu;

        return $this;
    }

    /**
     * @return Collection|ElementaryType[]
     */
    public function getPokemonEspece(): Collection
    {
        return $this->PokemonEspece;
    }

    public function addPokemonEspece(ElementaryType $pokemonEspece): self
    {
        if (!$this->PokemonEspece->contains($pokemonEspece)) {
            $this->PokemonEspece[] = $pokemonEspece;
        }

        return $this;
    }

    public function removePokemonEspece(ElementaryType $pokemonEspece): self
    {
        if ($this->PokemonEspece->contains($pokemonEspece)) {
            $this->PokemonEspece->removeElement($pokemonEspece);
        }

        return $this;
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
            $chass->setLieuCapture($this);
        }

        return $this;
    }

    public function removeChass(Chasse $chass): self
    {
        if ($this->chasses->contains($chass)) {
            $this->chasses->removeElement($chass);
            // set the owning side to null (unless already changed)
            if ($chass->getLieuCapture() === $this) {
                $chass->setLieuCapture(null);
            }
        }

        return $this;
    }
}
