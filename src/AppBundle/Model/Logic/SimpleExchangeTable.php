<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Model\Logic;

/**
 * Description of SimpleExchangeTable
 *
 * @author pj
 */
class SimpleExchangeTable {

    private $exchangeEntryArray;

    public function __construct() {
        $this->basicEntries();
    }

    /**
     * Future: It can be loaded from XML file
     */
    final private function basicEntries() {
        $this->exchangeEntryArray = array();
        $this->exchangeEntryArray[] = new ExchangeEntry(new \AppBundle\Model\Animal\Sheep, 1, new \AppBundle\Model\Animal\Rabbit, 6);
        $this->exchangeEntryArray[] = new ExchangeEntry(new \AppBundle\Model\Animal\Pig, 1, new \AppBundle\Model\Animal\Sheep, 2);
        $this->exchangeEntryArray[] = new ExchangeEntry(new \AppBundle\Model\Animal\Cow, 1, new \AppBundle\Model\Animal\Pig, 3);
        $this->exchangeEntryArray[] = new ExchangeEntry(new \AppBundle\Model\Animal\Horse, 1, new \AppBundle\Model\Animal\Cow, 2);
        $this->exchangeEntryArray[] = new ExchangeEntry(new \AppBundle\Model\Animal\Dog, 1, new \AppBundle\Model\Animal\Sheep, 1);
        $this->exchangeEntryArray[] = new ExchangeEntry(new \AppBundle\Model\Animal\BigDog, 1, new \AppBundle\Model\Animal\Cow, 1);
    }

    public function entryWithAnimals(\AppBundle\Model\Animal\AbstractAnimal $animalOne, \AppBundle\Model\Animal\AbstractAnimal $animalTwo): ExchangeEntry {
        foreach ($this->exchangeEntryArray as $value) {
            if ($value->hasAnimal($animalOne) && ($value->hasAnimal($animalTwo))) {
                return $value;
            }
        }
        return NULL;
    }

}
