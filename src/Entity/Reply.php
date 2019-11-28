<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ReplyRepository")
 */
class Reply
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $Afzender;

    /**
     * @ORM\Column(type="text")
     */
    private $Onderwerp;

    /**
     * @ORM\Column(type="text")
     */
    private $Bericht;

    /**
     * @ORM\Column(type="text")
     */
    private $Geadresseerde;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAfzender(): ?string
    {
        return $this->Afzender;
    }

    public function setAfzender(string $Afzender): self
    {
        $this->Afzender = $Afzender;

        return $this;
    }

    public function getOnderwerp(): ?string
    {
        return $this->Onderwerp;
    }

    public function setOnderwerp(string $Onderwerp): self
    {
        $this->Onderwerp = $Onderwerp;

        return $this;
    }

    public function getBericht(): ?string
    {
        return $this->Bericht;
    }

    public function setBericht(string $Bericht): self
    {
        $this->Bericht = $Bericht;

        return $this;
    }

    public function getGeadresseerde(): ?string
    {
        return $this->Geadresseerde;
    }

    public function setGeadresseerde(string $Geadresseerde): self
    {
        $this->Geadresseerde = $Geadresseerde;

        return $this;
    }
}
