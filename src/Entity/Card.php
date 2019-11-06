<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

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

//    /**
//     * @ORM\Column(type="integer")
//     */
//    private $imageId;

    /**
     * @ORM\Column(type="text", length=100)
     */
    private $title;

    /**
     * @ORM\Column(type="text", length=100)
     */
    private $customer;

    /**
     * @ORM\Column(type="text")
     */
    private $body;

    /**
     * @ORM\Column(type="text")
     */
    private $link;

    /**
     * @ORM\Column(type="text")
     */
    private $footer;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Image", mappedBy="card")
     */
    private $Images;

    public function __construct()
    {
        $this->Images = new ArrayCollection();
    }

    public function getId() {
        return $this->id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function getCustomer(){
        return $this->customer;
    }

    public  function setCustomer($customer){
        return $this->customer = $customer;
    }

    public function getBody() {
        return $this->body;
    }
    public function setBody($body) {
        $this->body = $body;
    }

    public function getLink() {
        return $this->link;
    }
    public function setLink($link) {
        $this->link = $link;
    }

    public function getFooter() {
        return $this->footer;
    }
    public function setFooter($footer) {
        $this->footer = $footer;
    }

    /**
     * @return Collection|Image[]
     */
    public function getImages(): Collection
    {
        return $this->Images;
    }

    public function addImage(Image $image): self
    {
        if (!$this->Images->contains($image)) {
            $this->Images[] = $image;
            $image->setCard($this);
        }

        return $this;
    }

    public function removeImage(Image $image): self
    {
        if ($this->Images->contains($image)) {
            $this->Images->removeElement($image);
            // set the owning side to null (unless already changed)
            if ($image->getCard() === $this) {
                $image->setCard(null);
            }
        }

        return $this;
    }

}
