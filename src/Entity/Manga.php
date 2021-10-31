<?php

namespace App\Entity;

use App\Repository\MangaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MangaRepository::class)
 */
class Manga
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titre;

    /**
     * @ORM\Column(type="integer")
     */
    private $numeros;

    /**
     * @ORM\ManyToOne(targetEntity=Series::class, inversedBy="mangas")
     * @ORM\JoinColumn(nullable=false)
     */
    private $serie;

    /**
     * @ORM\OneToMany(targetEntity=Commande::class, mappedBy="manga")
     */
    private $commandes;



    public function __construct()
    {
        $this->series = new ArrayCollection();
        $this->commandes = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->titre . ' - N°' . $this->numeros;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getNumeros(): ?int
    {
        return $this->numeros;
    }

    public function setNumeros(int $numeros): self
    {
        $this->numeros = $numeros;

        return $this;
    }

    public function getSerie(): ?Series
    {
        return $this->serie;
    }

    public function setSerie(?Series $serie): self
    {
        $this->serie = $serie;

        return $this;
    }

    /**
     * @return Collection|Commande[]
     */
    public function getCommandes(): Collection
    {
        return $this->commandes;
    }

    public function addCommande(Commande $commande): self
    {
        if (!$this->commandes->contains($commande)) {
            $this->commandes[] = $commande;
            $commande->setManga($this);
        }

        return $this;
    }

    public function removeCommande(Commande $commande): self
    {
        if ($this->commandes->removeElement($commande)) {
            // set the owning side to null (unless already changed)
            if ($commande->getManga() === $this) {
                $commande->setManga(null);
            }
        }

        return $this;
    }


}
