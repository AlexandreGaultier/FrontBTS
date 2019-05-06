<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VolRepository")
 */
class Vol
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */

    private $dateDepart;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateArrivee;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $placeEco;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $placePremium;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $placeBusiness;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $prixEco;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $prixPremium;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $prixBusiness;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Avion")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idAvion;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Billet", mappedBy="idVol")
     */
    private $listeBillets;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Aeroport", inversedBy="listeDepartVols")
     * @ORM\JoinColumn(nullable=false)
     */
    private $AeroportDepart;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Aeroport", inversedBy="listeArriveeVols")
     * @ORM\JoinColumn(nullable=false)
     */
    private $AeroportArrivee;

    public function __construct()
    {
        $this->listeBillets = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateDepart(): ?\DateTimeInterface
    {
        return $this->dateDepart;
    }

    public function setDateDepart(\DateTimeInterface $dateDepart): self
    {
        $this->dateDepart = $dateDepart;

        return $this;
    }

    public function getDateArrivee(): ?\DateTimeInterface
    {
        return $this->dateArrivee;
    }

    public function setDateArrivee(\DateTimeInterface $dateArrivee): self
    {
        $this->dateArrivee = $dateArrivee;

        return $this;
    }

    public function getPlaceEco(): ?int
    {
        return $this->placeEco;
    }

    public function setPlaceEco(?int $placeEco): self
    {
        $this->placeEco = $placeEco;

        return $this;
    }

    public function getPlacePremium(): ?int
    {
        return $this->placePremium;
    }

    public function setPlacePremium(?int $placePremium): self
    {
        $this->placePremium = $placePremium;

        return $this;
    }

    public function getPlaceBusiness(): ?int
    {
        return $this->placeBusiness;
    }

    public function setPlaceBusiness(?int $placeBusiness): self
    {
        $this->placeBusiness = $placeBusiness;

        return $this;
    }

    public function getPrixEco(): ?int
    {
        return $this->prixEco;
    }

    public function setPrixEco(?int $prixEco): self
    {
        $this->prixEco = $prixEco;

        return $this;
    }

    public function getPrixPremium(): ?int
    {
        return $this->prixPremium;
    }

    public function setPrixPremium(?int $prixPremium): self
    {
        $this->prixPremium = $prixPremium;

        return $this;
    }

    public function getPrixBusiness(): ?int
    {
        return $this->prixBusiness;
    }

    public function setPrixBusiness(?int $prixBusiness): self
    {
        $this->prixBusiness = $prixBusiness;

        return $this;
    }

    public function getIdAvion(): ?Avion
    {
        return $this->idAvion;
    }

    public function setIdAvion(?Avion $idAvion): self
    {
        $this->idAvion = $idAvion;

        return $this;
    }

    /**
     * @return Collection|Billet[]
     */
    public function getListeBillets(): Collection
    {
        return $this->listeBillets;
    }

    public function addListeBillet(Billet $listeBillet): self
    {
        if (!$this->listeBillets->contains($listeBillet)) {
            $this->listeBillets[] = $listeBillet;
            $listeBillet->setIdVol($this);
        }

        return $this;
    }

    public function removeListeBillet(Billet $listeBillet): self
    {
        if ($this->listeBillets->contains($listeBillet)) {
            $this->listeBillets->removeElement($listeBillet);
            // set the owning side to null (unless already changed)
            if ($listeBillet->getIdVol() === $this) {
                $listeBillet->setIdVol(null);
            }
        }

        return $this;
    }

    public function getAeroportDepart(): ?Aeroport
    {
        return $this->AeroportDepart;
    }

    public function setAeroportDepart(?Aeroport $AeroportDepart): self
    {
        $this->AeroportDepart = $AeroportDepart;

        return $this;
    }

    public function getAeroportArrivee(): ?Aeroport
    {
        return $this->AeroportArrivee;
    }

    public function setAeroportArrivee(?Aeroport $AeroportArrivee): self
    {
        $this->AeroportArrivee = $AeroportArrivee;

        return $this;
    }
}
