<?php

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\RecetteRepository;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;


/**
 * Recette
 * @ORM\Entity(repositoryClass="App\Repository\RecetteRepository", repositoryClass=RecetteRepository::class)
 * @ORM\Table(name="recette", indexes={@ORM\Index(name="cat_id", columns={"cat_id"}), @ORM\Index(name="membre_id", columns={"auteur"}), @ORM\Index(name="theme_id", columns={"theme_id"})})
 * @Vich\Uploadable()
 */

class Recette
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
     * @var File
     * @Vich\UploadableField(mapping="recette_image", fileNameProperty="photo")
     */
    private $image_file;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=150, nullable=false)
     */
    private $nom;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="active", type="boolean", nullable=true, options={"default"="1"})
     */
    private $active = true;

    /**
     * @var string
     *
     * @ORM\Column(name="descr", type="text", length=65535, nullable=false)
     */
    private $descr;

    /**
     * @var string|null
     * @ORM\Column(name="photo", type="string", length=255, nullable=true)
     */
    private $photo;

    /**
     * @var int|null
     *
     * @ORM\Column(name="rating_P", type="integer", nullable=true)
     */
    private $ratingP;

    /**
     * @var int|null
     *
     * @ORM\Column(name="rating_N", type="integer", nullable=true)
     */
    private $ratingN;

    /**
     * @var int
     *
     * @ORM\Column(name="tps_prep", type="integer", nullable=false)
     */
    private $tpsPrep;

    /**
     * @var int|null
     *
     * @ORM\Column(name="tps_cuisson", type="integer", nullable=true)
     */
    private $tpsCuisson;

    /**
     * @var int
     *
     * @ORM\Column(name="portion", type="integer", nullable=false)
     */
    private $portion;

    /**
     * @var int
     *
     * @ORM\Column(name="difficulte", type="integer", nullable=false)
     */
    private $difficulte;

    /**
     * @var \Membre
     *
     * @ORM\ManyToOne(targetEntity="Membre")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="auteur", referencedColumnName="id")
     * })
     */
    private $auteur;

    /**
     * @var \Theme
     *
     * @ORM\ManyToOne(targetEntity="Theme")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="theme_id", referencedColumnName="id")
     * })
     */
    private $theme;

    /**
     * @var \Categorie
     *
     * @ORM\ManyToOne(targetEntity="Categorie")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="cat_id", referencedColumnName="id")
     * })
     */
    private $cat;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Membre", inversedBy="recette")
     * @ORM\JoinTable(name="favorite",
     *   joinColumns={
     *     @ORM\JoinColumn(name="recette_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="membre_id", referencedColumnName="id")
     *   }
     * )
     */
    private $membre;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Produit", mappedBy="recette")
     */
    private $produit;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->membre = new \Doctrine\Common\Collections\ArrayCollection();
        $this->produit = new \Doctrine\Common\Collections\ArrayCollection();
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

    public function getActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(?bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    public function getDescr(): ?string
    {
        return $this->descr;
    }

    public function setDescr(string $descr): self
    {
        $this->descr = $descr;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(?string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    public function getRatingP(): ?int
    {
        return $this->ratingP;
    }

    public function setRatingP(?int $ratingP): self
    {
        $this->ratingP = $ratingP;

        return $this;
    }

    public function getRatingN(): ?int
    {
        return $this->ratingN;
    }

    public function setRatingN(?int $ratingN): self
    {
        $this->ratingN = $ratingN;

        return $this;
    }

    public function getTpsPrep(): ?int
    {
        return $this->tpsPrep;
    }

    public function setTpsPrep(int $tpsPrep): self
    {
        $this->tpsPrep = $tpsPrep;

        return $this;
    }

    public function getTpsCuisson(): ?int
    {
        return $this->tpsCuisson;
    }

    public function setTpsCuisson(?int $tpsCuisson): self
    {
        $this->tpsCuisson = $tpsCuisson;

        return $this;
    }

    public function getPortion(): ?int
    {
        return $this->portion;
    }

    public function setPortion(int $portion): self
    {
        $this->portion = $portion;

        return $this;
    }

    public function getDifficulte(): ?int
    {
        return $this->difficulte;
    }

    public function setDifficulte(int $difficulte): self
    {
        $this->difficulte = $difficulte;

        return $this;
    }

    public function getAuteur(): ?Membre
    {
        return $this->auteur;
    }

    public function setAuteur(?Membre $auteur): self
    {
        $this->auteur = $auteur;

        return $this;
    }

    public function getTheme(): ?Theme
    {
        return $this->theme;
    }

    public function setTheme(?Theme $theme): self
    {
        $this->theme = $theme;

        return $this;
    }

    public function getCat(): ?Categorie
    {
        return $this->cat;
    }

    public function setCat(?Categorie $cat): self
    {
        $this->cat = $cat;

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

    /**
     * @return Collection|Produit[]
     */
    public function getProduit(): Collection
    {
        return $this->produit;
    }

    public function addProduit(Produit $produit): self
    {
        if (!$this->produit->contains($produit)) {
            $this->produit[] = $produit;
            $produit->addRecette($this);
        }

        return $this;
    }

    public function removeProduit(Produit $produit): self
    {
        if ($this->produit->removeElement($produit)) {
            $produit->removeRecette($this);
        }

        return $this;
    }

    /**
     * @return null|File
     */
    public function getImageFile(): ?File
    {
        return $this->image_file;
    }


    /**
     * @param null|File $image_file
     * @return Recette
     */
    public function setImageFile(?File $image_file): Recette
    {
        $this->image_file = $image_file;
        return $this;
    }
}
