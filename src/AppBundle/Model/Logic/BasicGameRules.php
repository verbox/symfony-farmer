<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Model\Logic;

/**
 * Description of BasicGameLogic
 *
 * @author pj
 */
class BasicGameRules implements \AppBundle\Model\Logic\GameLogic {

    private $packableHerd;
    private $exchangeTable;

    public function __construct() {
        $this->packableHerd = NULL;
        $this->exchangeTable = new SimpleExchangeTable;
    }

    public function getPackableHerd() {
        return $this->packableHerd;
    }

    private function getInternState(): \AppBundle\Model\Herd\InternHerdState {
        return $this->packableHerd->getInternState();
    }

    public function addAnimalsToPackable(\AppBundle\Model\Animal\AbstractAnimal $animal, int $count) {
        if ($count > 0) {
            $intern_state = $this->getInternState();
            $intern_state->addAnimals($animal, $count);
        }
    }

    public function reproduce(\AppBundle\Model\Animal\AbstractAnimal... $animals) {
        if (count($animals) != 2) {
            echo "Blad";
            return;
        }
        if ($animals[0]->equalsKind($animals[1])) {
            $this->addAnimalsToPackable($animals[0], 1);
        } else {
            foreach ($animals as $animal) {
                $this->reproduceOneAnimal($animal);
            }
        }
    }

    private function reproduceOneAnimal(\AppBundle\Model\Animal\AbstractAnimal $animal) {
        $internState = $this->getInternState();
        $pairsCount = round((($internState->countOfAnimal($animal) + 1) / 2), 0, PHP_ROUND_HALF_DOWN);
        $this->addAnimalsToPackable($animal, $pairsCount);
    }

    public function setPackableHerd(\AppBundle\Model\Herd\PackableHerd $herd) {
        $this->packableHerd = $herd;
    }

    public function exchangeUnit(\AppBundle\Model\Animal\AbstractAnimal $firstAnimal, \AppBundle\Model\Animal\AbstractAnimal $secondAnimal) {
        //find entry
        $entry = $this->exchangeTable->entryWithAnimals($firstAnimal, $secondAnimal);
        //first unit count
        $faC = $entry->getMainSideCount($firstAnimal);
        //second unit count
        $faC = $entry->getOppositeSideCount($firstAnimal);
        //exchange
        $this->exchange($firstAnimal, $faC, $secondAnimal, $faC);
    }

    private function exchange(\AppBundle\Model\Animal\AbstractAnimal $fA, int $fN, \AppBundle\Model\Animal\AbstractAnimal $sA, int $sN) {
        $intern = $this->getInternState();
        //remove first animals
        $intern->removeAnimalsToZero($fA, $fN);
        //add second animals
        $intern->addAnimals($sA, $sN);
    }

    public function attack(\AppBundle\Model\Animal\AbstractAnimal $animal) {
        //check if animal can kill 
        if (count($animal->killOnly())) {
            //check if savers exists
            if ($this->ifSaverExists($animal)) {
                //remove one object of savers
                $this->removeSavers($animal->saveIfExists());
            } else {
                $animalsToKill = $this->prepareKillArray($animal);
                $intern = $this->getInternState();
                $animalFactory = \AppBundle\Model\Animal\SimpleAnimalFactory::getInstance();
                foreach ($animalsToKill as $animalName_to_kill) {
                    $animal = $animalFactory->createAnimal($animalName_to_kill);
                    $intern->removeAllAnimals($animal);
                }
            }
        }
    }

    private function ifSaverExists(\AppBundle\Model\Animal\AbstractAnimal $animal): bool {
        $intern = $this->getInternState();
        //get savers
        foreach ($animal->saveIfExists() as $animalName) {
            if (!$intern->hasAnimalString($animalName))
            //if does not exist - return false
                return false;
        }
        return true;
    }

    private function removeSavers(array $animalNames): bool {
        $intern = $this->getInternState();
        $animalFactory = \AppBundle\Model\Animal\SimpleAnimalFactory::getInstance();
        $removed = false;
        foreach ($animalNames as $animalName) {
            $intern->removeAnimal($animalFactory->createAnimal($animalName));
            $removed = true;
        }
        return $removed;
    }

    private function prepareKillArray(\AppBundle\Model\Animal\AbstractAnimal $animal): array {
        $animalFactory = \AppBundle\Model\Animal\SimpleAnimalFactory::getInstance();
        $animalsToKill = $animal->killOnly();
        if ($animalsToKill[0] == "ALL") {
            $animalsToKill = \AppBundle\Model\Animal\SimpleAnimalFactory::getAllAnimalsName();
        }
        //except
        if ($animal->killExcept())
            foreach ($animal->killExcept() as $animalNameEx) {
                $key = array_search($animalNameEx, $animalsToKill);
                if ($key !== false) {
                    unset($animalsToKill[$key]);
                }
            }
        return $animalsToKill;
    }

}
