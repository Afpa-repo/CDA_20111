<?php

namespace App\Entity;

use Cocur\Slugify\Slugify;
use App\Repository\ProduitRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Produit
 * @ORM\Entity(repositoryClass="App\Repository\ProduitRepository", repositoryClass=ProduitRepository::class)
 * @ORM\Table(name="produit", uniqueConstraints={@ORM\UniqueConstraint(name="ref", columns={"ref"})}, indexes={@ORM\Index(name="four_id", columns={"four_id"}), @ORM\Index(name="tp_id", columns={"tp_id"})})
 */


class Produit
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=150, nullable=false)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="ref", type="string", length=10, nullable=false)
     */
    private $ref;

    /**
     * @var string|null
     *
     * @ORM\Column(name="stock", type="decimal", precision=15, scale=2, nullable=true)
     */
    private $stock;

    /**
     * @var string
     *
     * @ORM\Column(name="prix", type="decimal", precision=6, scale=2, nullable=false)
     */
    private $prix;

    /**
     * @var int
     *
     * @ORM\Column(name="nbUniteMesure", type="integer", nullable=false)
     */
    private $nbunitemesure;

    /**
     * @var string
     *
     * @ORM\Column(name="uniteMesure", type="string", length=20, nullable=false)
     */
    private $unitemesure;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="saison", type="boolean", nullable=true)
     */
    private $saison;

    /**
     * @var string|null
     *
     * @ORM\Column(name="descr", type="text", length=65535, nullable=true)
     */
    private $descr;

    /**
     * @var string
     *
     * @ORM\Column(name="photo", type="string", length=255, nullable=false)
     */
    private $photo;

    /**
     * @var \TypeProduit
     *
     * @ORM\ManyToOne(targetEntity="TypeProduit")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tp_id", referencedColumnName="id")
     * })
     */
    private $tp;

    /**
     * @var \Fournisseur
     *
     * @ORM\ManyToOne(targetEntity="Fournisseur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="four_id", referencedColumnName="id")
     * })
     */
    private $four;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Recette", inversedBy="produit")
     * @ORM\JoinTable(name="ingredient",
     *   joinColumns={
     *     @ORM\JoinColumn(name="produit_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="recette_id", referencedColumnName="id")
     *   }
     * )
     */
    private $recette;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Commande", inversedBy="produit")
     * @ORM\JoinTable(name="ligne_commande",
     *   joinColumns={
     *     @ORM\JoinColumn(name="produit_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="commande_id", referencedColumnName="id")
     *   }
     * )
     */
    private $commande;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Membre", inversedBy="produit")
     * @ORM\JoinTable(name="produit_favori",
     *   joinColumns={
     *     @ORM\JoinColumn(name="produit_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="membre_id", referencedColumnName="id")
     *   }
     * )
     */
    private $membre;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->recette = new \Doctrine\Common\Collections\ArrayCollection();
        $this->commande = new \Doctrine\Common\Collections\ArrayCollection();
        $this->membre = new \Doctrine\Common\Collections\ArrayCollection();
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

    public function getSlug(): string
    {
        return (new Slugify())->slugify($this->nom);
    }

    public function getRef(): ?string
    {
        return $this->ref;
    }

    public function setRef(string $ref): self
    {
        $this->ref = $ref;

        return $this;
    }

    public function getStock(): ?string
    {
        return $this->stock;
    }

    public function setStock(?string $stock): self
    {
        $this->stock = $stock;

        return $this;
    }

    public function getPrix(): ?string
    {
        return $this->prix;
    }

    public function setPrix(string $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getNbunitemesure(): ?int
    {
        return $this->nbunitemesure;
    }

    public function setNbunitemesure(int $nbunitemesure): self
    {
        $this->nbunitemesure = $nbunitemesure;

        return $this;
    }

    public function getUnitemesure(): ?string
    {
        return $this->unitemesure;
    }

    public function setUnitemesure(string $unitemesure): self
    {
        $this->unitemesure = $unitemesure;

        return $this;
    }

    public function getSaison(): ?bool
    {
        return $this->saison;
    }

    public function setSaison(?bool $saison): self
    {
        $this->saison = $saison;

        return $this;
    }

    public function getDescr(): ?string
    {
        return $this->descr;
    }

    public function setDescr(?string $descr): self
    {
        $this->descr = $descr;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    public function getTp(): ?TypeProduit
    {
        return $this->tp;
    }

    public function setTp(?TypeProduit $tp): self
    {
        $this->tp = $tp;

        return $this;
    }

    public function getFour(): ?Fournisseur
    {
        return $this->four;
    }

    public function setFour(?Fournisseur $four): self
    {
        $this->four = $four;

        return $this;
    }

    /**
     * @return Collection|Recette[]
     */
    public function getRecette(): Collection
    {
        return $this->recette;
    }

    public function addRecette(Recette $recette): self
    {
        if (!$this->recette->contains($recette)) {
            $this->recette[] = $recette;
        }

        return $this;
    }

    public function removeRecette(Recette $recette): self
    {
        $this->recette->removeElement($recette);

        return $this;
    }

    /**
     * @return Collection|Commande[]
     */
    public function getCommande(): Collection
    {
        return $this->commande;
    }

    public function addCommande(Commande $commande): self
    {
        if (!$this->commande->contains($commande)) {
            $this->commande[] = $commande;
        }

        return $this;
    }

    public function removeCommande(Commande $commande): self
    {
        $this->commande->removeElement($commande);

        return $this;
    }

    /**
     * @return Collection|Membre[]
     */
    public function getMembre(): Collection
    {
        return $this->membre;
    }

    public function addMembre(Membre $membre): self
    {
        if (!$this->membre->contains($membre)) {
            $this->membre[] = $membre;
        }

        return $this;
    }

    public function removeMembre(Membre $membre): self
    {
        $this->membre->removeElement($membre);

        return $this;
    }

}
