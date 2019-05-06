<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ClientRepository")
 */
class Client
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
     * @ORM\Column(type="string", length=25)
     */
    private $prenom;

    /**
     * @ORM\Column(type="date")
     */
    private $dateNaissance;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $motDePasse;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $identifiant;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $sexe;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Billet", mappedBy="idClient")
     */
    private $listeClients;

    public function __construct()
    {
        $this->listeClients = new ArrayCollection();
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->dateNaissance;
    }

    public function setDateNaissance(\DateTimeInterface $dateNaissance): self
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    public function getMotDePasse(): ?string
    {
        return $this->motDePasse;
    }

    public function setMotDePasse(string $motDePasse): self
    {
        $this->motDePasse = $motDePasse;

        return $this;
    }

    public function getIdentifiant(): ?string
    {
        return $this->identifiant;
    }

    public function setIdentifiant(string $identifiant): self
    {
        $this->identifiant = $identifiant;

        return $this;
    }

    public function getSexe(): ?string
    {
        return $this->sexe;
    }

    public function setSexe(string $sexe): self
    {
        $this->sexe = $sexe;

        return $this;
    }

    /**
     * @return Collection|Billet[]
     */
    public function getListeClients(): Collection
    {
        return $this->listeClients;
    }

    public function addListeClient(Billet $listeClient): self
    {
        if (!$this->listeClients->contains($listeClient)) {
            $this->listeClients[] = $listeClient;
            $listeClient->setIdClient($this);
        }

        return $this;
    }

    public function removeListeClient(Billet $listeClient): self
    {
        if ($this->listeClients->contains($listeClient)) {
            $this->listeClients->removeElement($listeClient);
            // set the owning side to null (unless already changed)
            if ($listeClient->getIdClient() === $this) {
                $listeClient->setIdClient(null);
            }
        }

        return $this;
    }
}
