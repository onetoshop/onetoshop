<?php

namespace App\Entity;

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

    /**
     * @ORM\Column(type="text", length=100)
     */
    private $title;

    /**
     * @ORM\Column(type="text", length=100)
     */
    private $background_img;

    /**
     * @ORM\Column(type="text", length=100)
     */
    private $frond_img;

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



    public function getId() {
        return $this->id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function getBackground_img(){
        return $this->background_img;
    }

    public  function setBackground_img($background_img){
        return $this->background_img = $background_img;
    }

    public function getFront_img(){
        return $this->frond_img;
    }

    public  function setFrond_img($frond_img){
        return $this->frond_img = $frond_img;
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

}
