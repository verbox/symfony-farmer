<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Entity;

use AppBundle\Model\Animal\AbstractAnimal;
use AppBundle\Model\Animal\SimpleAnimalFactory;
use Doctrine\ORM\Mapping as ORM;
use Exception;

/**
 * Description of HerdEntry
 * @ORM\Entity
 * @ORM\Table(name="herd_entries")
 * @author learning
 */
class HerdEntry {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="AnimalType")
     * @ORM\JoinColumn(name="animal_id", referencedColumnName="id")
     */
    private $animalType;
    
    /**
     *
     * @ORM\Column(type="integer")
     */
    private $count;
    
    /**
     * @ORM\ManyToOne(targetEntity="Herd", inversedBy="animalEntries")
     * @ORM\JoinColumn(name="herd_id", referencedColumnName="id")
     * @var type 
     */
    private $herd;

    function __construct(AnimalType $animal, int $count) {
            $this->animalType = $animal;
            $this->count = $count;
    }

    function getAnimalName() {
        return $this->animalType->getName();
    }

    function getAnimalObject() : AbstractAnimal{
        return SimpleAnimalFactory::getInstance()->createAnimal($this->getAnimalName());
    }

    function getCount() {
        return $this->count;
    }
    
    function setAnimalType($animalType) {
        $this->animalType = $animalType;
    }

    function getAnimalType() {
        return $this->animalType;
    }

    
    function setCount($count) {
        $this->count = $count;
    }
    
    function getHerd(): Herd {
        return $this->herd;
    }

    function setHerd(Herd $herd) {
        $this->herd = $herd;
    }

    function getId() {
        return $this->id;
    }



}
