<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ImageRepository")
 */
class Image
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
    private $bg_img;

    private $fr_img;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Card", inversedBy="Images")
     */
    private $card;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBgImg(): ?string
    {
        return $this->bg_img;
    }

    public function setBgImg(string $bg_img): self
    {
        $this->bg_img = $bg_img;

        return $this;
    }

    public function getFrImg(): ?string
    {
        return $this->fr_img;
    }

    public function setFrImg(string $fr_img): self
    {
        $this->fr_img = $fr_img;

        return $this;
    }

    public function getCard(): ?Card
    {
        return $this->card;
    }

    public function setCard(?Card $card): self
    {
        $this->card = $card;

        return $this;
    }
}
