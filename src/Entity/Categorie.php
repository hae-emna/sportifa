<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity(repositoryClass=CategorieRepository::class)
 */
class Categorie
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     *@Assert\NotBlank(message="NOM is required")
     */
    private $Nom_Categorie;

    /**
     * @ORM\Column(type="string", length=255)
     *@Assert\NotBlank(message="Desciption is required")
     */
    private $Desciption;

    /**
     * @ORM\Column(type="string", length=255)
     *@Assert\NotBlank(message="Type is required")
     */
    private $Type;

    /**
     * @ORM\Column(type="integer")
     *@Assert\NotBlank(message="Reference is required")
     */
    private $Reference;

    /**
     * @ORM\Column(type="date")
     * @Assert\NotBlank(message="Logo is required")


     */
    private $Date_Ajout;

    /**
     * @ORM\OneToMany(targetEntity=Produit::class, mappedBy="categorie")
     */
    private $produits;

    public function __construct()
    {
        $this->produits = new ArrayCollection();
    }
    public function __toString() {
        return $this->Nom_Categorie;
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomCategorie(): ?string
    {
        return $this->Nom_Categorie;
    }

    public function setNomCategorie(string $Nom_Categorie): self
    {
        $this->Nom_Categorie = $Nom_Categorie;

        return $this;
    }

    public function getDesciption(): ?string
    {
        return $this->Desciption;
    }

    public function setDesciption(string $Desciption): self
    {
        $this->Desciption = $Desciption;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->Type;
    }

    public function setType(string $Type): self
    {
        $this->Type = $Type;

        return $this;
    }

    public function getReference(): ?int
    {
        return $this->Reference;
    }

    public function setReference(int $Reference): self
    {
        $this->Reference = $Reference;

        return $this;
    }

    public function getDateAjout(): ?\DateTimeInterface
    {
        return $this->Date_Ajout;
    }

    public function setDateAjout(?\DateTimeInterface $Date_Ajout): self
    {
        $this->Date_Ajout = $Date_Ajout;

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
            $produit->setCategorie($this);
        }

        return $this;
    }

    public function removeProduit(Produit $produit): self
    {
        if ($this->produits->removeElement($produit)) {
            // set the owning side to null (unless already changed)
            if ($produit->getCategorie() === $this) {
                $produit->setCategorie(null);
            }
        }

        return $this;
    }




}
