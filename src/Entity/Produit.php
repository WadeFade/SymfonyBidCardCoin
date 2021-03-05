<?php

namespace App\Entity;

use App\Repository\ProduitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProduitRepository::class)
 */
class Produit
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
    private $idProduit;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $nomProduit;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="float")
     */
    private $prixReserve;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $prixDepart;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $prixVente;

    /**
     * @ORM\Column(type="boolean")
     */
    private $estVendu;

    /**
     * @ORM\Column(type="boolean")
     */
    private $enStock;

    /**
     * @ORM\Column(type="smallint")
     */
    private $nbInvendu;

    /**
     * @ORM\ManyToOne(targetEntity=personne::class, inversedBy="produits")
     * @ORM\JoinColumn(nullable=false)
     */
    private $vendeur;

    /**
     * @ORM\OneToMany(targetEntity=Photo::class, mappedBy="produit")
     */
    private $photos;

    /**
     * @ORM\ManyToOne(targetEntity=categorie::class, inversedBy="produits")
     */
    private $categorie;

    /**
     * @ORM\ManyToOne(targetEntity=Lot::class, inversedBy="produits")
     */
    private $lot;

    /**
     * @ORM\ManyToOne(targetEntity=Personne::class, inversedBy="produitsAchete")
     */
    private $acheteur;

    /**
     * @ORM\OneToMany(targetEntity=Estimation::class, mappedBy="produit")
     */
    private $estimations;

    /**
     * @ORM\ManyToOne(targetEntity=stockage::class, inversedBy="produits")
     */
    private $stockage;

    public function __construct()
    {
        $this->photos = new ArrayCollection();
        $this->estimations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdProduit(): ?string
    {
        return $this->idProduit;
    }

    public function setIdProduit(string $idProduit): self
    {
        $this->idProduit = $idProduit;

        return $this;
    }

    public function getNomProduit(): ?string
    {
        return $this->nomProduit;
    }

    public function setNomProduit(string $nomProduit): self
    {
        $this->nomProduit = $nomProduit;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPrixReserve(): ?float
    {
        return $this->prixReserve;
    }

    public function setPrixReserve(float $prixReserve): self
    {
        $this->prixReserve = $prixReserve;

        return $this;
    }

    public function getPrixDepart(): ?float
    {
        return $this->prixDepart;
    }

    public function setPrixDepart(?float $prixDepart): self
    {
        $this->prixDepart = $prixDepart;

        return $this;
    }

    public function getPrixVente(): ?float
    {
        return $this->prixVente;
    }

    public function setPrixVente(?float $prixVente): self
    {
        $this->prixVente = $prixVente;

        return $this;
    }

    public function getEstVendu(): ?bool
    {
        return $this->estVendu;
    }

    public function setEstVendu(bool $estVendu): self
    {
        $this->estVendu = $estVendu;

        return $this;
    }

    public function getEnStock(): ?bool
    {
        return $this->enStock;
    }

    public function setEnStock(bool $enStock): self
    {
        $this->enStock = $enStock;

        return $this;
    }

    public function getNbInvendu(): ?int
    {
        return $this->nbInvendu;
    }

    public function setNbInvendu(int $nbInvendu): self
    {
        $this->nbInvendu = $nbInvendu;

        return $this;
    }

    public function getVendeur(): ?personne
    {
        return $this->vendeur;
    }

    public function setVendeur(?personne $vendeur): self
    {
        $this->vendeur = $vendeur;

        return $this;
    }

    /**
     * @return Collection|Photo[]
     */
    public function getPhotos(): Collection
    {
        return $this->photos;
    }

    public function addPhoto(Photo $photo): self
    {
        if (!$this->photos->contains($photo)) {
            $this->photos[] = $photo;
            $photo->setProduit($this);
        }

        return $this;
    }

    public function removePhoto(Photo $photo): self
    {
        if ($this->photos->removeElement($photo)) {
            // set the owning side to null (unless already changed)
            if ($photo->getProduit() === $this) {
                $photo->setProduit(null);
            }
        }

        return $this;
    }

    public function getCategorie(): ?categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?categorie $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getLot(): ?Lot
    {
        return $this->lot;
    }

    public function setLot(?Lot $lot): self
    {
        $this->lot = $lot;

        return $this;
    }

    public function getAcheteur(): ?Personne
    {
        return $this->acheteur;
    }

    public function setAcheteur(?Personne $acheteur): self
    {
        $this->acheteur = $acheteur;

        return $this;
    }

    /**
     * @return Collection|Estimation[]
     */
    public function getEstimations(): Collection
    {
        return $this->estimations;
    }

    public function addEstimation(Estimation $estimation): self
    {
        if (!$this->estimations->contains($estimation)) {
            $this->estimations[] = $estimation;
            $estimation->setProduit($this);
        }

        return $this;
    }

    public function removeEstimation(Estimation $estimation): self
    {
        if ($this->estimations->removeElement($estimation)) {
            // set the owning side to null (unless already changed)
            if ($estimation->getProduit() === $this) {
                $estimation->setProduit(null);
            }
        }

        return $this;
    }

    public function getStockage(): ?stockage
    {
        return $this->stockage;
    }

    public function setStockage(?stockage $stockage): self
    {
        $this->stockage = $stockage;

        return $this;
    }
}
