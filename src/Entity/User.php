<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $prenom;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateNaissance;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $telephone;

    /**
     * @ORM\Column(type="boolean")
     */
    private $verifIdentite = false;

    /**
     * @ORM\Column(type="smallint")
     */
    private $modePaiement = 0;

    /**
     * @ORM\ManyToMany(targetEntity=Adresse::class, mappedBy="personnes")
     */
    private $adresses;

    /**
     * @ORM\OneToMany(targetEntity=Produit::class, mappedBy="vendeur")
     */
    private $produitsAVendre;

    /**
     * @ORM\OneToMany(targetEntity=Produit::class, mappedBy="acquereur")
     */
    private $produitsAchete;

    /**
     * @ORM\OneToMany(targetEntity=Estimation::class, mappedBy="commissaire")
     */
    private $estimations;

    /**
     * @ORM\OneToMany(targetEntity=Enchere::class, mappedBy="commissaire")
     */
    private $encheresAsCommissaire;

    /**
     * @ORM\OneToMany(targetEntity=Enchere::class, mappedBy="encherisseur")
     */
    private $encheresAsEncherisseur;

    /**
     * @ORM\OneToMany(targetEntity=OrdreAchat::class, mappedBy="orderer")
     */
    private $ordreAchats;

    public function __construct()
    {
        $this->adresses = new ArrayCollection();
        $this->produitsAVendre = new ArrayCollection();
        $this->produitsAchete = new ArrayCollection();
        $this->estimations = new ArrayCollection();
        $this->encheresAsCommissaire = new ArrayCollection();
        $this->encheresAsEncherisseur = new ArrayCollection();
        $this->ordreAchats = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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

    public function getDateNaissance(): ?\DateTime
    {
        return $this->dateNaissance;
    }

    public function setDateNaissance(\DateTime $dateNaissance): self
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

    public function getVerifIdentite(): ?bool
    {
        return $this->verifIdentite;
    }

    public function setVerifIdentite(bool $verifIdentite): self
    {
        $this->verifIdentite = $verifIdentite;

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
     * @return Collection|Adresse[]
     */
    public function getAdresses(): Collection
    {
        return $this->adresses;
    }

    public function addAdress(Adresse $adress): self
    {
        if (!$this->adresses->contains($adress)) {
            $this->adresses[] = $adress;
            $adress->addPersonne($this);
        }

        return $this;
    }

    public function removeAdress(Adresse $adress): self
    {
        if ($this->adresses->removeElement($adress)) {
            $adress->removePersonne($this);
        }

        return $this;
    }

    /**
     * @return Collection|Produit[]
     */
    public function getProduitsAVendre(): Collection
    {
        return $this->produitsAVendre;
    }

    public function addProduitsAVendre(Produit $produitsAVendre): self
    {
        if (!$this->produitsAVendre->contains($produitsAVendre)) {
            $this->produitsAVendre[] = $produitsAVendre;
            $produitsAVendre->setVendeur($this);
        }

        return $this;
    }

    public function removeProduitsAVendre(Produit $produitsAVendre): self
    {
        if ($this->produitsAVendre->removeElement($produitsAVendre)) {
            // set the owning side to null (unless already changed)
            if ($produitsAVendre->getVendeur() === $this) {
                $produitsAVendre->setVendeur(null);
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
            $produitsAchete->setAcquereur($this);
        }

        return $this;
    }

    public function removeProduitsAchete(Produit $produitsAchete): self
    {
        if ($this->produitsAchete->removeElement($produitsAchete)) {
            // set the owning side to null (unless already changed)
            if ($produitsAchete->getAcquereur() === $this) {
                $produitsAchete->setAcquereur(null);
            }
        }

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
            $estimation->setCommissaire($this);
        }

        return $this;
    }

    public function removeEstimation(Estimation $estimation): self
    {
        if ($this->estimations->removeElement($estimation)) {
            // set the owning side to null (unless already changed)
            if ($estimation->getCommissaire() === $this) {
                $estimation->setCommissaire(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Enchere[]
     */
    public function getEncheresAsCommissaire(): Collection
    {
        return $this->encheresAsCommissaire;
    }

    public function addEncheresAsCommissaire(Enchere $encheresAsCommissaire): self
    {
        if (!$this->encheresAsCommissaire->contains($encheresAsCommissaire)) {
            $this->encheresAsCommissaire[] = $encheresAsCommissaire;
            $encheresAsCommissaire->setCommissaire($this);
        }

        return $this;
    }

    public function removeEncheresAsCommissaire(Enchere $encheresAsCommissaire): self
    {
        if ($this->encheresAsCommissaire->removeElement($encheresAsCommissaire)) {
            // set the owning side to null (unless already changed)
            if ($encheresAsCommissaire->getCommissaire() === $this) {
                $encheresAsCommissaire->setCommissaire(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Enchere[]
     */
    public function getEncheresAsEncherisseur(): Collection
    {
        return $this->encheresAsEncherisseur;
    }

    public function addEncheresAsEncherisseur(Enchere $encheresAsEncherisseur): self
    {
        if (!$this->encheresAsEncherisseur->contains($encheresAsEncherisseur)) {
            $this->encheresAsEncherisseur[] = $encheresAsEncherisseur;
            $encheresAsEncherisseur->setEncherisseur($this);
        }

        return $this;
    }

    public function removeEncheresAsEncherisseur(Enchere $encheresAsEncherisseur): self
    {
        if ($this->encheresAsEncherisseur->removeElement($encheresAsEncherisseur)) {
            // set the owning side to null (unless already changed)
            if ($encheresAsEncherisseur->getEncherisseur() === $this) {
                $encheresAsEncherisseur->setEncherisseur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|OrdreAchat[]
     */
    public function getOrdreAchats(): Collection
    {
        return $this->ordreAchats;
    }

    public function addOrdreAchat(OrdreAchat $ordreAchat): self
    {
        if (!$this->ordreAchats->contains($ordreAchat)) {
            $this->ordreAchats[] = $ordreAchat;
            $ordreAchat->setOrderer($this);
        }

        return $this;
    }

    public function removeOrdreAchat(OrdreAchat $ordreAchat): self
    {
        if ($this->ordreAchats->removeElement($ordreAchat)) {
            // set the owning side to null (unless already changed)
            if ($ordreAchat->getOrderer() === $this) {
                $ordreAchat->setOrderer(null);
            }
        }

        return $this;
    }
}
