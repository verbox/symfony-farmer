<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace AppBundle\Model;

use AppBundle\Entity\AnimalType;
use AppBundle\Entity\ExchangeEntry;
use AppBundle\Entity\HerdEntry;
/**
 * Description of ExchangeEntryViewEntry
 *
 * @author learning
 */
class FixedExchangeEntry {
    /**
     *
     * @var AnimalType
     */
    private $myAnimal;
    /**
     *
     * @var int
     */
    private $myAnimalCount;
    /**
     *
     * @var AnimalType
     */
    private $otherAnimal;
    /**
     *
     * @var int
     */
    private $otherAnimalCount;
    
    /**
     *
     * @var HerdEntry
     */
    private $entry;
    
    /**
     *
     * @var ExchangeEntry
     */
    private $exchangeEntry;
    
    public function __construct(ExchangeEntry $xchange, HerdEntry $entry) {
        $this->entry = $entry;
        $this->exchangeEntry=$xchange;
        $this->myAnimal=$entry->getAnimalType();
        if ($xchange->getFirstAnimal()==$this->myAnimal) {
            $this->otherAnimal=$xchange->getSecondAnimal();
            $this->otherAnimalCount=$xchange->getSecondCount();
            $this->myAnimalCount=$xchange->getFirstCount();
        }
        else {
            $this->otherAnimal=$xchange->getFirstAnimal();
            $this->otherAnimalCount=$xchange->getFirstCount();
            $this->myAnimalCount=$xchange->getSecondCount();
        }
    }
    
    public function getMyAnimal(): AnimalType {
        return $this->myAnimal;
    }

    public function getMyAnimalCount() {
        return $this->myAnimalCount;
    }

    public function getOtherAnimal(): AnimalType {
        return $this->otherAnimal;
    }

    public function getOtherAnimalCount() {
        return $this->otherAnimalCount;
    }

    public function getEntry(): HerdEntry {
        return $this->entry;
    }

    public function setMyAnimal(AnimalType $myAnimal) {
        $this->myAnimal = $myAnimal;
    }

    public function setMyAnimalCount($myAnimalCount) {
        $this->myAnimalCount = $myAnimalCount;
    }

    public function setOtherAnimal(AnimalType $otherAnimal) {
        $this->otherAnimal = $otherAnimal;
    }

    public function setOtherAnimalCount($otherAnimalCount) {
        $this->otherAnimalCount = $otherAnimalCount;
    }

    public function setEntry(HerdEntry $entry) {
        $this->entry = $entry;
    }

    public function getExchangeEntry(): ExchangeEntry {
        return $this->exchangeEntry;
    }

    public function setExchangeEntry(ExchangeEntry $exchangeEntry) {
        $this->exchangeEntry = $exchangeEntry;
    }



    
   

}
