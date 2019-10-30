<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\HoofdRepository")
 */
class Hoofd
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(length=128, unique=true)
     */
    private $slug;

    /**
     * @ORM\Column(type="text", length=100)
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $body;

    /**
     * @ORM\Column(type="text")
     */
    private $header1;

    /**
     * @ORM\Column(type="text")
     */
    private $body1;

    /**
     * @ORM\Column(type="text")
     */
    private $header2;

    /**
     * @ORM\Column(type="text")
     */
    private $body2;

    /**
     * @ORM\Column(type="text")
     */
    private $header3;

    /**
     * @ORM\Column(type="text")
     */
    private $body3;

    /**
     * @ORM\Column(type="text")
     */
    private $header4;

    /**
     * @ORM\Column(type="text")
     */
    private $body4;

    // Getters & Setters
    public function getId() {
        return $this->id;
    }

    public function getSlug() {
        return $this->slug;
    }

    public function setSlug($slug) {
        $this->slug = $slug;
    }

    public function getTitle() {
        return $this->title;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function getBody() {
        return $this->body;
    }

    public function setBody($body) {
        $this->body = $body;
    }

    public function getHeader1() {
        return $this->header1;
    }

    public function setHeader1($header1){
        $this->header1 = $header1;
    }

    public function getBody1() {
        return $this->body1;
    }

    public function setBody1($body1) {
        $this->body1 = $body1;
    }

    public function getHeader2() {
        return $this->header2;
    }

    public function setHeader2($header2){
        $this->header2 = $header2;
    }

    public function getBody2() {
        return $this->body2;
    }

    public function setBody2($body2) {
        $this->body2 = $body2;
    }

    public function getHeader3() {
        return $this->header3;
    }

    public function setHeader3($header3){
        $this->header3 = $header3;
    }

    public function getBody3() {
        return $this->body3;
    }

    public function setBody3($body3) {
        $this->body3 = $body3;
    }

    public function getHeader4() {
        return $this->header4;
    }

    public function setHeader4($header4){
        $this->header4 = $header4;
    }

    public function getBody4() {
        return $this->body4;
    }

    public function setBody4($body4) {
        $this->body4 = $body4;
    }
}
