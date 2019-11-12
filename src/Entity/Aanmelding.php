<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Illuminate\Support\Facades\App;


/**
 * @ORM\Entity(repositoryClass="App\Repository\AanmeldingRepository")
 */
class Aanmelding
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $voornaam;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $achternaam;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $telefoon;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $bereik;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $keuz;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVoornaam(): ?string
    {
        return $this->voornaam;
    }

    public function setVoornaam(string $voornaam): self
    {
        $this->voornaam = $voornaam;

        return $this;
    }

    public function getAchternaam(): ?string
    {
        return $this->achternaam;
    }

    public function setAchternaam(string $achternaam): self
    {
        $this->achternaam = $achternaam;

        return $this;
    }

    public function getTelefoon(): ?string
    {
        return $this->telefoon;
    }

    public function setTelefoon(string $telefoon): self
    {
        $this->telefoon = $telefoon;

        return $this;
    }

    public function getBereik(): ?string
    {
        return $this->bereik;
    }

    public function setBereik(string $bereik): self
    {
        $this->bereik = $bereik;

        return $this;
    }

    public function getKeuz(): ?string
    {
        return $this->keuz;
    }

    public function setKeuz(string $keuz): self
    {
        $this->keuz = $keuz;

        return $this;
    }
}
