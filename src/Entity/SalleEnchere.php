<?php

namespace App\Entity;

use App\Repository\SalleEnchereRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SalleEnchereRepository::class)
 */
class SalleEnchere
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
    private $idSalleEnchere;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomVente;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity=adresse::class, inversedBy="salleEncheres")
     */
    private $adresse;

    /**
     * @ORM\OneToMany(targetEntity=Enchere::class, mappedBy="salleVente")
     */
    private $encheres;

    public function __construct()
    {
        $this->encheres = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdSalleEnchere(): ?string
    {
        return $this->idSalleEnchere;
    }

    public function setIdSalleEnchere(string $idSalleEnchere): self
    {
        $this->idSalleEnchere = $idSalleEnchere;

        return $this;
    }

    public function getNomVente(): ?string
    {
        return $this->nomVente;
    }

    public function setNomVente(string $nomVente): self
    {
        $this->nomVente = $nomVente;

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

    public function getAdresse(): ?adresse
    {
        return $this->adresse;
    }

    public function setAdresse(?adresse $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * @return Collection|Enchere[]
     */
    public function getEncheres(): Collection
    {
        return $this->encheres;
    }

    public function addEnchere(Enchere $enchere): self
    {
        if (!$this->encheres->contains($enchere)) {
            $this->encheres[] = $enchere;
            $enchere->setSalleVente($this);
        }

        return $this;
    }

    public function removeEnchere(Enchere $enchere): self
    {
        if ($this->encheres->removeElement($enchere)) {
            // set the owning side to null (unless already changed)
            if ($enchere->getSalleVente() === $this) {
                $enchere->setSalleVente(null);
            }
        }

        return $this;
    }
}
