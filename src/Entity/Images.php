<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToMany;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ImagesRepository")
 */
class Images
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
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Media", mappedBy="images")
     */
    private $media;



    private $file;


    /**
     * One product has many features. This is the inverse side.
     * @OneToMany(targetEntity="Images", mappedBy="blog")
     */
    private $blog;

    /**
     * One product has many features. This is the inverse side.
     * @OneToMany(targetEntity="Images", mappedBy="apps")
     */
    private $apps;

    /**
     * One product has many features. This is the inverse side.
     * @OneToMany(targetEntity="Images", mappedBy="card")
     */
    private $card;

    /**
     * One product has many features. This is the inverse side.
     * @OneToMany(targetEntity="Images", mappedBy="card")
     */
    private $card1;


    /**
     * One product has many features. This is the inverse side.
     * @OneToMany(targetEntity="Images", mappedBy="project")
     */
    private $project;

    public function __construct()
    {
        $this->media = new ArrayCollection();
        $this->blog = new ArrayCollection();
        $this->apps = new ArrayCollection();
        $this->card = new ArrayCollection();
        $this->card1 = new ArrayCollection();
        $this->project = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|Media[]
     */
    public function getMedia(): Collection
    {
        return $this->media;
    }

    public function addMedium(Media $medium): self
    {
        if (!$this->media->contains($medium)) {
            $this->media[] = $medium;
            $medium->setImages($this);
        }

        return $this;
    }

    public function removeMedium(Media $medium): self
    {
        if ($this->media->contains($medium)) {
            $this->media->removeElement($medium);
            // set the owning side to null (unless already changed)
            if ($medium->getImages() === $this) {
                $medium->setImages(null);
            }
        }

        return $this;
    }
    public function getFile()
    {
        return $this->file;
    }

    public function setFile(UploadedFile $file): void
    {
        $this->file = $file;
    }

    /**
     * @return Collection|Blog[]
     */
    public function getBlog(): Collection
    {
        return $this->blog;
    }

    public function addBlog(Blog $blog): self
    {
        if (!$this->blog->contains($blog)) {
            $this->blog[] = $blog;
            $blog->setImages($this);
        }

        return $this;
    }

    public function removeBlog(Blog $blog): self
    {
        if ($this->blog->contains($blog)) {
            $this->blog->removeElement($blog);
            // set the owning side to null (unless already changed)
            if ($blog->getImages() === $this) {
                $blog->setImages(null);
            }
        }

        return $this;
    }


}
