<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Model\Animal;

class SimpleAnimalFactory {

    private static $instance;
    private static $allAnimalsName = array("Rabbit", "Pig", "Sheep", "Horse", "Cow", "Dog", "BigDog", "Wolf", "Fox");
    
    public function randomAnimals(int $count) : array{
        $result = array();
        for($i = 0; $i < $count; ++$i)
        {
            $result[] = self::$allAnimalsName[rand() % 5];
        }
        return $result;
    }

    private function __constructor() {
        
    }

    private function __clone() {
        
    }

    public static function getAllAnimalsName(): array {
        return self::$allAnimalsName;
    }

    public static function getInstance(): self {
        if (self::$instance == NULL) {
            self::$instance = new SimpleAnimalFactory;
        }
        return self::$instance;
    }
    
    public function isValidAnimalName(string $animal) : bool
    {
        if (in_array($animal, SimpleAnimalFactory::$allAnimalsName))
                return true;
        return false;
    }

    public function createAnimal(string $animalName): AbstractAnimal {
        if (strcmp($animalName, "Rabbit") == 0) {
            return new Rabbit;
        }
        if (strcmp($animalName, "Pig") == 0) {
            return new Pig;
        }
        if (strcmp($animalName, "Sheep") == 0) {
            return new Sheep;
        }
        if (strcmp($animalName, "Horse") == 0) {
            return new Horse;
        }
        if (strcmp($animalName, "Cow") == 0) {
            return new Cow;
        }
        if (strcmp($animalName, "Dog") == 0) {
            return new Dog;
        }
        if (strcmp($animalName, "BigDog") == 0) {
            return new BigDog;
        }
        if (strcmp($animalName, "Fox") == 0) {
            return new Fox;
        }
        if (strcmp($animalName, "Wolf") == 0) {
            return new Wolf;
        }
    }

}
