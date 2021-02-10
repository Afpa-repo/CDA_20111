<?php

namespace App\Entity;

use DateTime;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\FactureRepository;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\Date;

/**
 * Facture
 * @ORM\Entity(repositoryClass="App\Repository\FactureRepository", repositoryClass=FactureRepository::class)
 * @ORM\Table(name="facture")
 */
class Facture
{
    /**
     * @var array|string représentant les différents types de paiement disponibles
     */
    public const PAIEMENT = [0 => "Carte Bancaire", 1 => "Paypal"];

    /**
     * @var array|string représentant les différentes civilités
     */
    public const CIVILITE = [1 => "Madame", 2 => "Mademoiselle", 3 => "Monsieur", 0=>"Inconnue" ];


    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int
     * @ORM\Column(type="smallint")
     */
    private $civilite;

    /**
     * @var string
     * @ORM\Column(type="string", length=150)
     * @Assert\Length(min=2, max=150)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=150, nullable=false)
     * @Assert\Length(min=5, max=255)
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
     * @Assert\Length(min=5, max=150)
     */
    private $adresse2;

    /**
     * @var string
     *
     * @ORM\Column(name="cp", type="string", length=5, nullable=false)
     * @Assert\Length(min=5, max=5)
     */
    private $cp;

    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=150, nullable=false)
     * @Assert\Length(min=5, max=150)
     */
    private $ville;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="date_edition", type="date", nullable=false)
     */
    private $dateEdition;

    /**
     * @var int
     * @ORM\Column(type="smallint")
     */
    private $paiement;

    public function __construct(){
        $this->setDateEdition(new DateTime());
        $this->setCivilite(0);
        $this->setPaiement(0);
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

    public function getDateEdition(): Date
    {
        return date('m/d/Y', $this->dateEdition);
    }

    public function setDateEdition(DateTimeInterface $dateEdition): self
    {
        $this->dateEdition = $dateEdition;

        return $this;
    }

    public function getPaiement(): ?string
    {
        return (self::PAIEMENT[$this->paiement]);
    }

    public function setPaiement(int $paiement): self
    {
        $this->paiement = $paiement;

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

    public function getCivilite(): ?string
    {
        return (self::CIVILITE[$this->civilite]);
    }

    public function setCivilite(int $civilite): self
    {
        $this->civilite = $civilite;
        return $this;
    }


}
