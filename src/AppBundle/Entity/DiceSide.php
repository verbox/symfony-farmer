<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="dice_sides")
 */
class DiceSide {
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="Dice", inversedBy="sides")
     * @ORM\JoinColumn(name="dice_id", referencedColumnName="id")
     */
    private $dice;
    
    /**
     * @ORM\ManyToOne(targetEntity="AnimalType")
     * @ORM\JoinColumn(name="animal_id", referencedColumnName="id")
     */
    private $animalType;
    
    private $rollType;
    
    function __construct() {
        
    }
    
    function getId() {
        return $this->id;
    }

    function getDice() {
        return $this->dice;
    }

    function getAnimalType() {
        return $this->animalType;
    }

    function getRollType() {
        return $this->rollType;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setDice($dice) {
        $this->dice = $dice;
    }

    function setAnimalType($animalType) {
        $this->animalType = $animalType;
    }

    function setRollType($rollType) {
        $this->rollType = $rollType;
    }



}
