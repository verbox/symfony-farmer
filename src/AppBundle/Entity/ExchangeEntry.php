<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Entity;

use AppBundle\Model\FixedExchangeEntry;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity
 * @ORM\Table(name="exchange_entries")
 */
class ExchangeEntry {
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="AnimalType")
     * @ORM\JoinColumn(name="first_animal_id", referencedColumnName = "id")
     */
    private $firstAnimal;
    
    /**
     * @ORM\ManyToOne(targetEntity="AnimalType")
     * @ORM\JoinColumn(name="second_animal_id", referencedColumnName = "id")
     */
    private $secondAnimal;
    
    /**
     * @ORM\Column(type="integer")
     */
    private $firstCount;
    
    /**
     * @ORM\Column(type="integer")
     */
    private $secondCount;
    
    function __construct() {
        
    }

    public function getId() {
        return $this->id;
    }

    public function getFirstAnimal() {
        return $this->firstAnimal;
    }

    public function getSecondAnimal() {
        return $this->secondAnimal;
    }

    public function getFirstCount() {
        return $this->firstCount;
    }

    public function getSecondCount() {
        return $this->secondCount;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setFirstAnimal($firstAnimal) {
        $this->firstAnimal = $firstAnimal;
    }

    public function setSecondAnimal($secondAnimal) {
        $this->secondAnimal = $secondAnimal;
    }

    public function setFirstCount($firstCount) {
        $this->firstCount = $firstCount;
    }

    public function setSecondCount($secondCount) {
        $this->secondCount = $secondCount;
    }
    
    public function createFixedExchangeEntry(HerdEntry $entry) {
        return new FixedExchangeEntry($this,$entry);
    }
    
    public function getOtherAnimal(HerdEntry $entry) : AnimalType {
        
    }
    
    public function getOtherAnimalCount(HerdEntry $entry) :int {
        
    }


}
