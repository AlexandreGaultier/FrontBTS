<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ClientRepository")
 * @UniqueEntity(
 * fields={"email"},
 * message="L'email entré est déjà utilisé."
 * )
 */
class Client implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min="8", minMessage="Votre mot de passe doit faire au minimum 8 caractères.")
     */
    private $Password;

    /**
     * @Assert\EqualTo(propertyPath="Password", message="Vous n'avez entré le même mot de passe.")
     */
    public $confirm_Password;
    
    /**
     * @ORM\Column(type="string", length=50)
     */
    private $Username;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $sexe;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Billet", mappedBy="idClient")
     */
    private $listeClients;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Email()
     */
    private $email;

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

    public function getPassword(): ?string
    {
        return $this->Password;
    }

    public function setPassword(string $Password): self
    {
        $this->Password = $Password;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->Username;
    }

    public function setUsername(string $Username): self
    {
        $this->Username = $Username;

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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function eraseCredentials() {}
    
    public function getSalt() {}

    public function getRoles() {
        return ['ROLE_USER'];
    }
}
