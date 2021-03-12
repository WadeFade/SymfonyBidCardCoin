<?php

namespace App\Entity;

use App\Repository\PhotoRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PhotoRepository::class)
 */
class Photo
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $nomPhoto;

    /**
     * @ORM\Column(type="text")
     */
    private $urlPhoto;

    /**
     * @ORM\ManyToOne(targetEntity=Produit::class, inversedBy="photos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $produit;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomPhoto(): ?string
    {
        return $this->nomPhoto;
    }

    public function setNomPhoto(string $nomPhoto): self
    {
        $this->nomPhoto = $nomPhoto;

        return $this;
    }

    public function getUrlPhoto(): ?string
    {
        return $this->urlPhoto;
    }

    public function setUrlPhoto(string $urlPhoto): self
    {
        $this->urlPhoto = $urlPhoto;

        return $this;
    }

    public function getProduit(): ?Produit
    {
        return $this->produit;
    }

    public function setProduit(?Produit $produit): self
    {
        $this->produit = $produit;

        return $this;
    }
}
