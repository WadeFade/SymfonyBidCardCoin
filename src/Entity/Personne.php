<?php

namespace App\Entity;

use App\Repository\PersonneRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PersonneRepository::class)
 */
class Personne
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
    private $idPersonne;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $nomPersonne;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $prenomPersonne;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateNaissance;

    /**
     * @ORM\Column(type="string", length=45)
     */
    private $telephone;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="boolean")
     */
    private $verifIdentite;

    /**
     * @ORM\Column(type="smallint")
     */
    private $role;

    /**
     * @ORM\Column(type="smallint")
     */
    private $modePaiement;

    /**
     * @ORM\ManyToMany(targetEntity=adresse::class, inversedBy="personnes")
     */
    private $adresse;

    /**
     * @ORM\OneToMany(targetEntity=Produit::class, mappedBy="vendeur")
     */
    private $produits;

    /**
     * @ORM\OneToMany(targetEntity=Produit::class, mappedBy="acheteur")
     */
    private $produitsAchete;

    public function __construct()
    {
        $this->adresse = new ArrayCollection();
        $this->produits = new ArrayCollection();
        $this->produitsAchete = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdPersonne(): ?string
    {
        return $this->idPersonne;
    }

    public function setIdPersonne(string $idPersonne): self
    {
        $this->idPersonne = $idPersonne;

        return $this;
    }

    public function getNomPersonne(): ?string
    {
        return $this->nomPersonne;
    }

    public function setNomPersonne(string $nomPersonne): self
    {
        $this->nomPersonne = $nomPersonne;

        return $this;
    }

    public function getPrenomPersonne(): ?string
    {
        return $this->prenomPersonne;
    }

    public function setPrenomPersonne(string $prenomPersonne): self
    {
        $this->prenomPersonne = $prenomPersonne;

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

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

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

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getVerifIdentite(): ?bool
    {
        return $this->verifIdentite;
    }

    public function setVerifIdentite(bool $verifIdentite): self
    {
        $this->verifIdentite = $verifIdentite;

        return $this;
    }

    public function getRole(): ?int
    {
        return $this->role;
    }

    public function setRole(int $role): self
    {
        $this->role = $role;

        return $this;
    }

    public function getModePaiement(): ?int
    {
        return $this->modePaiement;
    }

    public function setModePaiement(int $modePaiement): self
    {
        $this->modePaiement = $modePaiement;

        return $this;
    }

    /**
     * @return Collection|adresse[]
     */
    public function getAdresse(): Collection
    {
        return $this->adresse;
    }

    public function addAdresse(adresse $adresse): self
    {
        if (!$this->adresse->contains($adresse)) {
            $this->adresse[] = $adresse;
        }

        return $this;
    }

    public function removeAdresse(adresse $adresse): self
    {
        $this->adresse->removeElement($adresse);

        return $this;
    }

    /**
     * @return Collection|Produit[]
     */
    public function getProduits(): Collection
    {
        return $this->produits;
    }

    public function addProduit(Produit $produit): self
    {
        if (!$this->produits->contains($produit)) {
            $this->produits[] = $produit;
            $produit->setVendeur($this);
        }

        return $this;
    }

    public function removeProduit(Produit $produit): self
    {
        if ($this->produits->removeElement($produit)) {
            // set the owning side to null (unless already changed)
            if ($produit->getVendeur() === $this) {
                $produit->setVendeur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Produit[]
     */
    public function getProduitsAchete(): Collection
    {
        return $this->produitsAchete;
    }

    public function addProduitsAchete(Produit $produitsAchete): self
    {
        if (!$this->produitsAchete->contains($produitsAchete)) {
            $this->produitsAchete[] = $produitsAchete;
            $produitsAchete->setAcheteur($this);
        }

        return $this;
    }

    public function removeProduitsAchete(Produit $produitsAchete): self
    {
        if ($this->produitsAchete->removeElement($produitsAchete)) {
            // set the owning side to null (unless already changed)
            if ($produitsAchete->getAcheteur() === $this) {
                $produitsAchete->setAcheteur(null);
            }
        }

        return $this;
    }
}
