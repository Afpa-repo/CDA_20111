<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\CommentairesRepository;

/**
 * Commentaires
 * @ORM\Entity(repositoryClass="App\Repository\CommentairesRepository", repositoryClass=CommentairesRepository::class)
 * @ORM\Table(name="commentaires", indexes={@ORM\Index(name="membre_id", columns={"membre_id"}), @ORM\Index(name="recette_id", columns={"recette_id"})})
 */
class Commentaires
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
     * @ORM\Column(name="contenu", type="text", length=65535, nullable=false)
     */
    private $contenu;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=false)
     */
    private $date;

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
     * @var \Membre
     *
     * @ORM\ManyToOne(targetEntity="Membre")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="membre_id", referencedColumnName="id")
     * })
     */
    private $membre;

    /**
     * @var \Recette
     *
     * @ORM\ManyToOne(targetEntity="Recette")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="recette_id", referencedColumnName="id")
     * })
     */
    private $recette;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    public function setContenu(string $contenu): self
    {
        $this->contenu = $contenu;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

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

    public function getMembre(): ?Membre
    {
        return $this->membre;
    }

    public function setMembre(?Membre $membre): self
    {
        $this->membre = $membre;

        return $this;
    }

    public function getRecette(): ?Recette
    {
        return $this->recette;
    }

    public function setRecette(?Recette $recette): self
    {
        $this->recette = $recette;

        return $this;
    }


}
