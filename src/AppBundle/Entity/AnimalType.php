<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Description of Animal
 * @ORM\Entity
 * @ORM\Table(name="animal_types")
 * @author learning
 */
class AnimalType {
    
    const FARM_ANIMALS_KIND = ["NORMAL","GUARD"]; 
    
     /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\Column(type="string")
     * @var string
     */
    private $name;
    
    /**
     * @ORM\Column(type="string")
     */
    private $kind;
    
    /**
     * @ORM\Column(type="boolean")
     */
    private $canAttack;

    function getName() {
        return $this->name;
    }

    function getKind() {
        return $this->kind;
    }

    function getCanAttack() {
        return $this->canAttack;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setKind($kind) {
        $this->kind = $kind;
    }

    function setCanAttack($canAttack) {
        $this->canAttack = $canAttack;
    }

    function getId() {
        return $this->id;
    }


    
}
