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
     * @ORM\ManyToOne(targetEntity="App\Entity\Apps", inversedBy="parent")
     */
    private $apps;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Apps", mappedBy="apps")
     */
    private $parent;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $naam;

    /**
     * @Slug("naam")
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $slug;



    public function __construct()
    {
        $this->parent = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImage(): ?Image
    {
        return $this->image;
    }

    public function setImage($image): void
    {
        $this->image = $image;
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

    public function getApps(): ?self
    {
        return $this->apps;
    }

    public function setApps(?self $apps): self
    {
        $this->apps = $apps;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getParent(): Collection
    {
        return $this->parent;
    }

    public function addParent(self $parent): self
    {
        if (!$this->parent->contains($parent)) {
            $this->parent[] = $parent;
            $parent->setApps($this);
        }

        return $this;
    }

    public function removeParent(self $parent): self
    {
        if ($this->parent->contains($parent)) {
            $this->parent->removeElement($parent);
            // set the owning side to null (unless already changed)
            if ($parent->getApps() === $this) {
                $parent->setApps(null);
            }
        }

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

}
