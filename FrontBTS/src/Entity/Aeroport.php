<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AeroportRepository")
 */
class Aeroport
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $pays;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Vol", mappedBy="AeroportDepart")
     */
    private $listeDepartVols;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Vol", mappedBy="AeroportArrivee")
     */
    private $listeArriveeVols;

    public function __construct()
    {
        $this->listeDepartVols = new ArrayCollection();
        $this->listeArriveeVols = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPays(): ?string
    {
        return $this->pays;
    }

    public function setPays(string $pays): self
    {
        $this->pays = $pays;

        return $this;
    }

    /**
     * @return Collection|Vol[]
     */
    public function getListeDepartVols(): Collection
    {
        return $this->listeDepartVols;
    }

    public function addListeDepartVol(Vol $listeDepartVol): self
    {
        if (!$this->listeDepartVols->contains($listeDepartVol)) {
            $this->listeDepartVols[] = $listeDepartVol;
            $listeDepartVol->setAeroportDepart($this);
        }

        return $this;
    }

    public function removeListeDepartVol(Vol $listeDepartVol): self
    {
        if ($this->listeDepartVols->contains($listeDepartVol)) {
            $this->listeDepartVols->removeElement($listeDepartVol);
            // set the owning side to null (unless already changed)
            if ($listeDepartVol->getAeroportDepart() === $this) {
                $listeDepartVol->setAeroportDepart(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Vol[]
     */
    public function getListeArriveeVols(): Collection
    {
        return $this->listeArriveeVols;
    }

    public function addListeArriveeVol(Vol $listeArriveeVol): self
    {
        if (!$this->listeArriveeVols->contains($listeArriveeVol)) {
            $this->listeArriveeVols[] = $listeArriveeVol;
            $listeArriveeVol->setAeroportArrivee($this);
        }

        return $this;
    }

    public function removeListeArriveeVol(Vol $listeArriveeVol): self
    {
        if ($this->listeArriveeVols->contains($listeArriveeVol)) {
            $this->listeArriveeVols->removeElement($listeArriveeVol);
            // set the owning side to null (unless already changed)
            if ($listeArriveeVol->getAeroportArrivee() === $this) {
                $listeArriveeVol->setAeroportArrivee(null);
            }
        }

        return $this;
    }
}
