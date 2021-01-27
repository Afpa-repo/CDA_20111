<?php

namespace App\Entity;

use App\Repository\PointRetraitRepository;
use Doctrine\ORM\Mapping as ORM;
use Cocur\Slugify\Slugify;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass="App\Repository\PointRetraitRepository", repositoryClass=PointRetraitRepository::class)
 * @UniqueEntity("nom")
 */
class PointRetrait
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    const HORAIRES = [
        0 => "08:00", 1 => "08:30", 2 => "09:00", 3 => "09:30", 4 => "10:00",
        5 => "10:30", 6 => "11:00", 7 => "11:30", 8 => "12:00", 9 => "12:30",
        10 => "13:00", 11 => "13:30", 12 => "14:00", 13 => "14:30", 14 => "15:00",
        15 => "15:30", 16 => "16:00", 17 => "16:30", 18 => "17:00", 19 => "17:30",
        20 => "18:00", 21 => "18:30", 22 => "19:00", 23 => "19:30", 24 => "20:00",
    ];
    const JOURS = ['Lundi','Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];

    /**
     * @Assert\Length(min=5, max=255)
     * @ORM\Column(type="string", length=150)
     */
    private $nom;

    /**
     * @Assert\Length(min=5, max=255)
     * @ORM\Column(type="string", length=255)
     */
    private $adresse;

    /**
     * @Assert\Regex("/^[0-9]{5}/")
     * @ORM\Column(type="string", length=5)
     */
    private $cp;

    /**
     * @Assert\Regex("/^[a-zA-Z\-éèêàâïìîòôù0-9\s]{150}/")
     * @ORM\Column(type="string", length=150)
     */
    private $ville;

    /**
     * @Assert\Regex("/^[a-zA-Z\-éèêàâïìîòôù0-9\/\+\@\s]{150}/")
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     * extension de l'image facultative du point retrait
     */
    private $image;

    /**
     * @ORM\Column(type="string", length=5)
     * heure d'ouverture du point retrait
     */
    private $ouverture;

    /**
     * @ORM\Column(type="string", length=5)
     * heure de fermeture du point retrait
     */
    private $fermeture;

    /**
     * @ORM\Column(type="string", length=100)
     * jour d'ouverture du point retrait
     */
    private $jour;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

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

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getOuverture(): ?string
    {
        return $this->ouverture;
    }

    public function setOuverture(string $ouverture): self
    {
        $this->ouverture = $ouverture;

        return $this;
    }

    public function getFermeture(): ?string
    {
        return $this->fermeture;
    }

    public function setFermeture(string $fermeture): self
    {
        $this->fermeture = $fermeture;

        return $this;
    }

    public function getJour(): ?string
    {
        return $this->jour;
    }

    public function setJour(string $jour): self
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
}
