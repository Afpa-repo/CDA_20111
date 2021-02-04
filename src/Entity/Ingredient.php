<?php

namespace App\Entity;

use App\Repository\IngredientRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=IngredientRepository::class)
 */
class Ingredient
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=TypeProduit::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $nom;

    /**
     * @ORM\Column(type="smallint")
     */
    private $nbUniteMesure;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $uniteMesure;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?TypeProduit
    {
        return $this->nom;
    }

    public function setNom(?TypeProduit $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getNbUniteMesure(): ?int
    {
        return $this->nbUniteMesure;
    }

    public function setNbUniteMesure(int $nbUniteMesure): self
    {
        $this->nbUniteMesure = $nbUniteMesure;

        return $this;
    }

    public function getUniteMesure(): ?string
    {
        return $this->uniteMesure;
    }

    public function setUniteMesure(string $uniteMesure): self
    {
        $this->uniteMesure = $uniteMesure;

        return $this;
    }
}
