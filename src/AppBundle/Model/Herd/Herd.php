<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Model\Herd;

use AppBundle\Model\Logic;
use AppBundle\Model\Animal\AbstractAnimal;

/**
 * Description of Herd
 *
 * @author pj
 */
class Herd implements PackableHerd {

    private $internState;
    private $gameLogic;

    public function __construct() {
        $this->internState = new InternHerdState;
        //Dependency Injection will be good idea here
        $this->gameLogic = (new Logic\StandardGameLogicFactory())->getGameRules("standard");
        $this->gameLogic->setPackableHerd($this);
    }

    protected function getGameLogic(): Logic\GameLogic {
        return $this->gameLogic;
    }

    public function getAnimals(): array {
        return $this->internState->getAnimalMap();
    }

    public function addAnimals(\AppBundle\Model\Animal\AbstractAnimal $animalObj, int $count) {
        $this->getGameLogic()->addAnimalsToPackable($animalObj, $count, $this);
    }

    public function reproduce(AbstractAnimal $firstAnimal, AbstractAnimal $secondAnimal) {
        $this->getGameLogic()->reproduce($firstAnimal, $secondAnimal);
    }

    public function getInternState(): InternHerdState {
        return $this->internState;
    }

    public function exchange(AbstractAnimal $firstAnimal, AbstractAnimal $secondAnimal) {
        $this->getGameLogic()->exchangeUnit($firstAnimal, $secondAnimal);
    }

    public function attack(AbstractAnimal $animal) {
        $this->getGameLogic()->attack($animal);
    }

}
