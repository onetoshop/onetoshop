<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
//use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Fbeen\UniqueSlugBundle\Annotation\Slug;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

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
     * Many features have one product. This is the owning side.
     * @ManyToOne(targetEntity="Images", inversedBy="apps")
     * @JoinColumn(name="images_id", referencedColumnName="id")
     */
    private $images;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $beschrijving;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $naam;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Apps", inversedBy="children")
     */
    private $parent;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Apps", mappedBy="parent", cascade={"persist", "remove"})
     */
    private $children;

    /**
     * @ORM\Column(type="string", length=255, nullable=false, unique=true)
     * @Slug("naam")
     */
    private $slug;

    /**
     * @ORM\Column(type="boolean")
     */
    private $publiceer;

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

    public function getImages(): ?Images
    {
        return $this->images;
    }

    public function setImages(?Images $images): self
    {
        $this->images = $images;

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

    public function getPubliceer(): ?bool
    {
        return $this->publiceer;
    }

    public function setPubliceer(bool $publiceer): self
    {
        $this->publiceer = $publiceer;

        return $this;
    }

}
