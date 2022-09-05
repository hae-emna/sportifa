<?php

namespace App\Entity;

use App\Repository\PanierRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PanierRepository::class)
 */
class Panier
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
    private $Lib;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Produit;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLib(): ?string
    {
        return $this->Lib;
    }

    public function setLib(string $Lib): self
    {
        $this->Lib = $Lib;

        return $this;
    }

    public function getProduit(): ?string
    {
        return $this->Produit;
    }

    public function setProduit(string $Produit): self
    {
        $this->Produit = $Produit;

        return $this;
    }
}
