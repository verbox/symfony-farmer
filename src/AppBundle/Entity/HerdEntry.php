<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Entity;

use Farmer\Animal\AbstractAnimal;
use Farmer\Animal\SimpleAnimalFactory;
use Doctrine\ORM\Mapping as ORM;

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
     * 
     * @ORM\Column(type="string")
     */
    private $animal;
    
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

    function __construct(AbstractAnimal $animalObj, int $count, Herd $herd) {
        if (SimpleAnimalFactory::getInstance()->isValidAnimalName($animalObj)) {
            $this->animal = $animalObj . getKind();
            $this->count = $count;
            $this->herd = $herd;
        } else {
            throw new Exception("Problem with animals - bad animal name/object"
            . "while creating new herd entry");
        }
    }

    function getAnimal() {
        return $this->animal;
    }

    function getAnimalObject() {
        return SimpleAnimalFactory::getInstance()->createAnimal($this->getAnimal());
    }

    function getCount() {
        return $this->count;
    }

    function setAnimal($animal) {
        $this->animal = $animal;
        if (!array_key_exists($animal, SimpleAnimalFactory::getInstance()->getAllAnimalsName())) {
            throw new Exception("Problem with animals - bad animal name/object"
            . "while setting herd entry");
        }
    }

    function setCount($count) {
        $this->count = $count;
    }

}
