<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Model\Logic;

/**
 * Description of ExchangeEntry
 *
 * @author pj
 */
class ExchangeEntry {

    private $leftSideEntry; //key = animal name, value = number of this 
    private $rightSideEntry;

    public function __construct(\AppBundle\Model\Animal\AbstractAnimal $firstAnimal, int $numberFirst, \AppBundle\Model\Animal\AbstractAnimal $secondAnimal, int $numberSecond) {
        $this->leftSideEntry[$firstAnimal->getKind()] = $numberFirst;
        $this->rightSideEntry[$secondAnimal->getKind()] = $numberSecond;
    }

    public function hasAnimal(\AppBundle\Model\Animal\AbstractAnimal $animal): bool {
        return (array_key_exists($animal->getKind(), $this->leftSideEntry) || array_key_exists($animal->getKind(), $this->rightSideEntry)
                );
    }

    public function getMainSide(\AppBundle\Model\Animal\AbstractAnimal $animal): array {
        if (array_key_exists($animal->getKind(), $this->leftSideEntry)) {
            return $this->leftSideEntry;
        }
        return $this->rightSideEntry;
    }

    public function getOppositeSide(\AppBundle\Model\Animal\AbstractAnimal $animal): array {
        if (array_key_exists($animal->getKind(), $this->leftSideEntry)) {
            return $this->rightSideEntry;
        }
        return $this->leftSideEntry;
    }

    public function getOppositeSideCount(\AppBundle\Model\Animal\AbstractAnimal $animal): int {
        $side = $this->getOppositeSide($animal);
        $val = array_values($side)[0];
        return $val;
    }

    public function getMainSideCount(\AppBundle\Model\Animal\AbstractAnimal $animal): int {
        $side = $this->getMainSide($animal);
        $val = array_values($side)[0];
        return $val;
    }

}
