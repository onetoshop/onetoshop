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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $imageFilename;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Upload", mappedBy="image", orphanRemoval=true)
     */
    private $bgimage;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Upload", mappedBy="image", orphanRemoval=true)
     */
    private $frimage;

    public function __construct()
    {
        $this->bgimage = new ArrayCollection();
        $this->frimage = new ArrayCollection();
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

    public function getImageFilename(): ?string
    {
        return $this->imageFilename;
    }
    public function setImageFilename(?string $imageFilename): self
    {
        $this->imageFilename = $imageFilename;
        return $this;
    }

    public function getImagePath()
    {
        return 'images/'.$this->getImageFilename();
    }

    public function __toString()
    {
        return (string)$this->getId();
    }

    /**
     * @return Collection|Upload[]
     */
    public function getBgimage(): Collection
    {
        return $this->bgimage;
    }

    public function addBgimage(Upload $bgimage): self
    {
        if (!$this->bgimage->contains($bgimage)) {
            $this->bgimage[] = $bgimage;
            $bgimage->setImage($this);
        }

        return $this;
    }

    public function removeBgimage(Upload $bgimage): self
    {
        if ($this->bgimage->contains($bgimage)) {
            $this->bgimage->removeElement($bgimage);
            // set the owning side to null (unless already changed)
            if ($bgimage->getImage() === $this) {
                $bgimage->setImage(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Upload[]
     */
    public function getFrimage(): Collection
    {
        return $this->frimage;
    }

    public function addFrimage(Upload $frimage): self
    {
        if (!$this->frimage->contains($frimage)) {
            $this->frimage[] = $frimage;
            $frimage->setImage($this);
        }

        return $this;
    }

    public function removeFrimage(Upload $frimage): self
    {
        if ($this->frimage->contains($frimage)) {
            $this->frimage->removeElement($frimage);
            // set the owning side to null (unless already changed)
            if ($frimage->getImage() === $this) {
                $frimage->setImage(null);
            }
        }

        return $this;
    }
}
