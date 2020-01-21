<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Fbeen\UniqueSlugBundle\Annotation\Slug;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AppsRepository")
 */
class Apps
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="Image", cascade={"persist", "remove"})
     */
    private $image;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $beschrijving;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $naam;

    /**
     * @Slug("naam")
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $slug;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Apps", inversedBy="children")
     */
    private $parent;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Apps", mappedBy="parent", cascade={"persist", "remove"})
     */
    private $children;

    public function __construct()
    {
        $this->children = new ArrayCollection();
    }

    public function getParent(): ?self
    {
        return $this->parent;
    }

    public function setParent(?self $parent): self
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getChildren(): Collection
    {
        return $this->children;
    }

    public function addChild(self $child): self
    {
        if (!$this->children->contains($child)) {
            $this->children[] = $child;
            $child->setParent($this);
        }

        return $this;
    }

    public function removeChild(self $child): self
    {
        if ($this->children->contains($child)) {
            $this->children->removeElement($child);
            // set the owning side to null (unless already changed)
            if ($child->getParent() === $this) {
                $child->setParent(null);
            }
        }

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBeschrijving(): ?string
    {
        return $this->beschrijving;
    }

    public function setBeschrijving(?string $beschrijving): self
    {
        $this->beschrijving = $beschrijving;

        return $this;
    }

    public function getNaam(): ?string
    {
        return $this->naam;
    }

    public function setNaam(?string $naam): self
    {
        $this->naam = $naam;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getImage(): ?Image
    {
        return $this->image;
    }

    public function setImage(?Image $image): self
    {
        $this->image = $image;

        return $this;
    }

}
