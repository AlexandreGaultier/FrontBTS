<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AvionRepository")
 */
class Avion
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

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
     * @ORM\Column(type="string", length=25)
     */
    private $nom;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }
}
