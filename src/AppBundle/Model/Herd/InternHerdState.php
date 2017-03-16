<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Model\Herd;

/**
 * Description of InternHerdState
 *
 * @author pj
 */
use AppBundle\Model\Animal\AbstractAnimal;
use AppBundle\Model\Animal\SimpleAnimalFactory;

class InternHerdState {

    private $animalMap;

    public function __construct() {
        $this->animalMap = array();
    }

    public function getAnimalMap() {
        return $this->animalMap;
    }

    public function addAnimal(AbstractAnimal $animal) {
        $currentValue = 0;
        $index = $animal->getKind();
        if (array_key_exists($index, $this->animalMap)) {
            $currentValue = $this->animalMap[$index];
        }
        $currentValue += 1;
        $this->animalMap[$index] = $currentValue;
    }

    private function removeAnimalFromMapToZero(AbstractAnimal $animal) {
        $this->removeAnimalsFromMapToZero($animal, 1);
    }

    private function removeAnimalsFromMapToZero(AbstractAnimal $animal, int $count) {
        $index = $animal->getKind();
        if (array_key_exists($index, $this->animalMap)) {
            $current = $this->animalMap[$index];
            if ($current >= $count) {
                $this->animalMap[$index] -= $count;
            } else {
                $this->animalMap[$index] = 0;
            }
        }
        if ($this->animalMap[$index] == 0) {
            unset($this->animalMap[$index]);
        }
    }

    /**
     * Remove animal from herd.
     * It removes <u>one</u> animal from both map and list structures.
     * @param AbstractAnimal $animal removed animal
     */
    public function removeAnimal(AbstractAnimal $animal) {
        $this->removeAnimalFromMapToZero($animal);
    }

    public function removeAnimalsToZero(AbstractAnimal $animal, int $count) {
        $this->removeAnimalsFromMapToZero($animal, $count);
    }

    private function removeAllAnimalsFromMap(AbstractAnimal $animal) {
        unset($this->animalMap[$animal->getKind()]);
    }

    public function removeAllAnimals(AbstractAnimal $animal) {
        $this->removeAllAnimalsFromMap($animal);
    }

    public function addAnimals(AbstractAnimal $animal, int $count) {
        $index = $animal->getKind();

        $current_value = 0;

        if (array_key_exists($index, $this->animalMap)) {
            $current_value = $this->animalMap[$index];
        }
        $current_value += $count;
        $this->animalMap[$index] = $current_value;
    }

    public function countPairs(AbstractAnimal $animal): int {
        $index = $animal->getKind();
        $count = 0;
        if (array_key_exists($index, $this->animalMap)) {
            $count = $this->animalMap[$index] / 2;
        }
        return $count;
    }

    public function countOfAnimal(AbstractAnimal $animal) {
        $index = $animal->getKind();
        $count = 0;
        $animalMap = $this->getAnimalMap();
        if (array_key_exists($index, $animalMap)) {
            $count = $animalMap[$index];
        }
        return $count;
    }

    public function countOfAnimalString(string $animalName): int {
        $animalMap = $this->getAnimalMap();
        if (array_key_exists($animalName, $animalMap)) {
            return $animalMap[$animalName];
        }
        return 0;
    }

    public function hasAnimalString(string $animalName): bool {
        return ($this->countOfAnimalString($animalName) > 0);
    }

}
