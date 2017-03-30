<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\GameRules\BasicGameRules;

use AppBundle\Entity\Herd;
use AppBundle\Entity\RollDice;
use AppBundle\GameRules\ActionInterfaces\RollDiceAction;
use AppBundle\GameRules\GameRulesDispatcher;

/**
 * Description of BasicRollDiceAction
 *
 * @author learning
 */
class BasicRollDiceAction implements RollDiceAction{

    private $dispatcher;
    public function doRollDice(string $type) {
        
    }

    public function rollDiceInHerd(RollDice $rollDice, Herd $herd) : RollDice {       
        //check if there is bad animal
        $firstDice = $rollDice->getDiceSides()->get(0);
        $secondDice = $rollDice->getDiceSides()->get(1);
        $firstAnimal = $firstDice->getAnimalType();
        $secondAnimal = $secondDice->getAnimalType();
        if ($firstAnimal->getKind()=="NORMAL" && $secondAnimal->getKind()=="NORMAL") {
            //if both animals are normal - try to reproduce its
            $reproduceRules = $this->getGameRulesDispatcher()
                    ->getReproduceAction();
            $reproduceRules->reproduceAnimals($herd, array($firstAnimal,$secondAnimal));
        }
        $diceRepository = $this->getGameRulesDispatcher()->getDiceRepository();
        $diceRepository->add($rollDice);
        return $rollDice;
    }

    public function setGameRulesDispatcher(GameRulesDispatcher $dispatcher) {
        $this->dispatcher = $dispatcher;
    }

    public function getGameRulesDispatcher(): GameRulesDispatcher {
        return $this->dispatcher;
    }

}
