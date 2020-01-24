<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BlogRepository")
 */
class Blog
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
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $body;




    /**
     * @ORM\Column(type="text", )
     * @Assert\Length(
     *      min = 2,
     *      max = 175,
     *      minMessage = "De beschrijving moet minimaal  {{ limit }} characters bevatten",
     *      maxMessage   = "De beschrijving mag maximaal {{ limit }} characters bevatten"
     * )
     */
    private $beschrijving;

    /**
     * @ORM\Column(type="text")
     */
    private $slug;

    /**
     * @ORM\Column(type="text")
     */
    private $tabtitle;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getBody(): ?string
    {
        return $this->body;
    }

    public function setBody(string $body): self
    {
        $this->body = $body;

        return $this;
    }


    public function getBeschrijving(): ?string
    {
        return $this->beschrijving;
    }

    public function setBeschrijving(string $beschrijving): self
    {
        $this->beschrijving = $beschrijving;

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

    public function getTabtitle(): ?string
    {
        return $this->tabtitle;
    }

    public function setTabtitle(string $tabtitle): self
    {
        $this->tabtitle = $tabtitle;

        return $this;
    }

   
}
