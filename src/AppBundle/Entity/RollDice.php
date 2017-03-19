<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Description of RollDice
 *
 * Description of Herd
 * @ORM\Entity
 * @ORM\Table(name="roll_dice_actions")
 * @author learning
 */
class RollDice {
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var long 
     */
    protected $id;
    
    /**
     * @ORM\Column(type="simple_array")
     */
    private $animals;
    
    /**
     * @ORM\Column(type="datetime")
     */
    private $time;
    
    /**
     * @ORM\ManyToOne(targetEntity="Herd", inversedBy="rollDiceActions")
     * @ORM\JoinColumn(name="herd_id", referencedColumnName = "id")
     */
    private $herd;
    
    function __construct($animals, $herd) {
        $this->animals = $animals;
        $this->herd = $herd;
        $this->time = new \DateTime();
    }
    
    function getId(): long {
        return $this->id;
    }

    function getAnimals() {
        return $this->animals;
    }

    function getTime() {
        return $this->time;
    }

    function setAnimals($animals) {
        $this->animals = $animals;
    }

    function setTime($time) {
        $this->time = $time;
    }

    function getFirstAnimal(): string {
        return $this->animals[0];
    }

    function getSecondAnimal(): string {
        return $this->animals[1];
    }
    
    function getHerd() {
        return $this->herd;
    }

    function setHerd($herd) {
        $this->herd = $herd;
    }


}
