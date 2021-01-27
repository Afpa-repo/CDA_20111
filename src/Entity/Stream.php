<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Stream
 *
 * @ORM\Table(name="stream", indexes={@ORM\Index(name="streamer_id", columns={"streamer_id"})})
 * @ORM\Entity
 */
class Stream
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
     * @var \DateTime
     *
     * @ORM\Column(name="st_date", type="date", nullable=false)
     */
    private $stDate;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=100, nullable=false)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="st_url", type="string", length=200, nullable=false)
     */
    private $stUrl;

    /**
     * @var string|null
     *
     * @ORM\Column(name="descr", type="string", length=300, nullable=true)
     */
    private $descr;

    /**
     * @var \Streamer
     *
     * @ORM\ManyToOne(targetEntity="Streamer")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="streamer_id", referencedColumnName="id")
     * })
     */
    private $streamer;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStDate(): ?\DateTimeInterface
    {
        return $this->stDate;
    }

    public function setStDate(\DateTimeInterface $stDate): self
    {
        $this->stDate = $stDate;

        return $this;
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

    public function getStUrl(): ?string
    {
        return $this->stUrl;
    }

    public function setStUrl(string $stUrl): self
    {
        $this->stUrl = $stUrl;

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

    public function getStreamer(): ?Streamer
    {
        return $this->streamer;
    }

    public function setStreamer(?Streamer $streamer): self
    {
        $this->streamer = $streamer;

        return $this;
    }


}
