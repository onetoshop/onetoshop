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
     * @ORM\OneToOne(targetEntity="App\Entity\Card", cascade={"persist", "remove"})
     */
    private $name;

    /**
     * @ORM\Column(type="text")
     */
    private $bg_img;

    private $fr_img;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?Card
    {
        return $this->name;
    }

    public function setName(?Card $name): self
    {
        $this->name = $name;

        return $this;
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
}
