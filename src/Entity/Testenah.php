<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TestenahRepository")
 */
class Testenah
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
    private $bakfiets;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBakfiets(): ?string
    {
        return $this->bakfiets;
    }

    public function setBakfiets(string $bakfiets): self
    {
        $this->bakfiets = $bakfiets;

        return $this;
    }
}
