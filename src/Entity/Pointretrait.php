<?php

namespace App\Entity;

use App\Repository\PointretraitRepository;
use App\Entity\Fournisseur;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Cocur\Slugify\Slugify;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\Collection;

/**
 * Pointretrait
 * @ORM\Entity(repositoryClass=PointretraitRepository::class)
 * @ORM\Table(name="pointretrait")
 * @UniqueEntity("nom") //ceci définit le champs "nom" comme unique dans la base de données. Les erreurs de doublons seront ainsi traitées
 */
class Pointretrait
{
    const HORAIRES = [
        0 => "08:00", 1 => "08:30", 2 => "09:00", 3 => "09:30", 4 => "10:00",
        5 => "10:30", 6 => "11:00", 7 => "11:30", 8 => "12:00", 9 => "12:30",
        10 => "13:00", 11 => "13:30", 12 => "14:00", 13 => "14:30", 14 => "15:00",
        15 => "15:30", 16 => "16:00", 17 => "16:30", 18 => "17:00", 19 => "17:30",
        20 => "18:00", 21 => "18:30", 22 => "19:00", 23 => "19:30", 24 => "20:00",
    ];
    const JOURS = ['Lundi','Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];

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
     * @Assert\Length(min=5, max=150)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse1", type="string", length=150, nullable=false)
     * @Assert\Length(min=5, max=150)
     */
    private $adresse1;

    /**
     * @var string|null
     *
     * @ORM\Column(name="adresse2", type="string", length=150, nullable=true)
     * @Assert\Length(max=150)
     */
    private $adresse2;

    /**
     * @var string
     *
     * @ORM\Column(name="cp", type="string", length=5, nullable=false)
     * @Assert\Length(min=5, max=5)
     * @Assert\Regex("/^[0-9]{5}/")
     */
    private $cp;

    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=150, nullable=false)
     * @Assert\Length(min=3, max=150)
     * @Assert\Regex("/^[a-zA-Z\-éèêàâïìîòôù0-9\s]{150}/")
     */
    private $ville;

    /**
     * @var string|null
     *
     * @ORM\Column(name="descr", type="text", length=65535, nullable=true)
     * @Assert\Regex("/^[a-zA-Z\-éèêàâïìîòôù0-9\/\+\@\s]{150}/")
     * @Assert\Length(max=65535)
     */
    private $descr;

    /**
     * @var string|null
     *
     * @ORM\Column(name="photo", type="string", length=255, nullable=true)
     * @Assert\Regex("/^([a-zA-Z0-9]{1,250})(\.jpg|\.jpeg|\.png)/")
     */
    private $photo;

    /**
     * heure d'ouverture du point retrait (voir const HORAIRES[])
     * @var int
     * @ORM\Column(name="ouverture", type="integer", nullable=false)
     */
    private $ouverture;

    /**
     * heure de fermeture du point retrait (voir const HORAIRES[])
     * @var int
     * @ORM\Column(name="fermeture", type="integer", nullable=false)
     */
    private $fermeture;

    /**
     * jour d'ouverture du point retrait (voir const JOURS[])
     * @var int
     * @ORM\Column(name="jour", type="integer", nullable=false)
     */
    private $jour;

    /**
     * @var int
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=false)
     */
    private $email;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Fournisseur", mappedBy="pr")
     */
    private $four;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->four = new ArrayCollection();
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

    public function getAdresse1(): ?string
    {
        return $this->adresse1;
    }

    public function setAdresse1(string $adresse1): self
    {
        $this->adresse1 = $adresse1;

        return $this;
    }

    public function getAdresse2(): ?string
    {
        return $this->adresse2;
    }

    public function setAdresse2(?string $adresse2): self
    {
        $this->adresse2 = $adresse2;

        return $this;
    }

    public function getCp(): ?string
    {
        return $this->cp;
    }

    public function setCp(string $cp): self
    {
        $this->cp = $cp;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

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

    public function setPhoto(?string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    public function getOuverture(): ?string
    {
        return self::HORAIRES[$this->ouverture];
    }

    public function setOuverture(int $ouverture): self
    {
        $this->ouverture = $ouverture;

        return $this;
    }

    public function getFermeture(): ?string
    {
        return self::HORAIRES[$this->fermeture];
    }

    public function setFermeture(int $fermeture): self
    {
        $this->fermeture = $fermeture;

        return $this;
    }

    public function getJour(): ?string
    {
        return self::JOURS[$this->jour];
    }

    public function setJour(int $jour): self
    {
        $this->jour = $jour;

        return $this;
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
     * @return Collection|Fournisseur[]
     */
    public function getFour(): Collection
    {
        return $this->four;
    }

    public function addFour(Fournisseur $four): self
    {
        if (!$this->four->contains($four)) {
            $this->four[] = $four;
            $four->addPr($this);
        }

        return $this;
    }

    public function removeFour(Fournisseur $four): self
    {
        if ($this->four->removeElement($four)) {
            $four->removePr($this);
        }

        return $this;
    }

}
