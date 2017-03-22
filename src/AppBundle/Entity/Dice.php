<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity
 * @ORM\Table(name="dices")
 */
class Dice {
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\OneToMany(targetEntity="DiceSide",mappedBy="dice", cascade={"persist","remove"})
     */
    private $sides;

    public function getId() {
        return $this->id;
    }
    
    public function setId($id) {
        $this->id = $id;
    }

    public function __construct() {
        $this->sides = new ArrayCollection();
    }
    
    public function getSides() {
        return $this->sides;
    }

    public function setSides($sides) {
        $this->sides = $sides;
    }

    public function random() {
        $count = $this->getSides()->count();
        assert($count > 0);
        $random = rand() % $count;
        return $this->getSides()->get($random);
    }

}
