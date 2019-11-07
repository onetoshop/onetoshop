<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Illuminate\Support\Facades\App;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CardRepository")
 */
class Card
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $customer;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $body;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $link;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $footer;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\File", mappedBy="image")
     */
    private $background_image;

    public function __construct()
    {
        $this->background_image = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getCustomer(): ?string
    {
        return $this->customer;
    }

    public function setCustomer(?string $customer): self
    {
        $this->customer = $customer;

        return $this;
    }

    public function getBody(): ?string
    {
        return $this->body;
    }

    public function setBody(?string $body): self
    {
        $this->body = $body;

        return $this;
    }

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function setLink(?string $link): self
    {
        $this->link = $link;

        return $this;
    }

    public function getFooter(): ?string
    {
        return $this->footer;
    }

    public function setFooter(?string $footer): self
    {
        $this->footer = $footer;

        return $this;
    }

    public function __toString()
    {
        return (string)$this->getId();
    }

    /**
     * @return Collection|File[]
     */
    public function getBackgroundImage(): Collection
    {
        return $this->background_image;
    }

    public function addBackgroundImage(File $backgroundImage): self
    {
        if (!$this->background_image->contains($backgroundImage)) {
            $this->background_image[] = $backgroundImage;
            $backgroundImage->setImage($this);
        }

        return $this;
    }

    public function removeBackgroundImage(File $backgroundImage): self
    {
        if ($this->background_image->contains($backgroundImage)) {
            $this->background_image->removeElement($backgroundImage);
            // set the owning side to null (unless already changed)
            if ($backgroundImage->getImage() === $this) {
                $backgroundImage->setImage(null);
            }
        }

        return $this;
    }
}
