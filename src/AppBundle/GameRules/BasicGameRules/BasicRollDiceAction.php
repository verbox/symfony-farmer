<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\GameRules\BasicGameRules;

use AppBundle\Entity\Herd;
use AppBundle\GameRules\ActionInterfaces\RollDiceAction;
use AppBundle\GameRules\GameRulesDispatcher;

/**
 * Description of BasicRollDiceAction
 *
 * @author learning
 */
class BasicRollDiceAction implements RollDiceAction{

    private $gameRulesDispatcher;
    public function doRollDice(string $type) {
        
    }

    public function rollDicesInHerd(array $rollDices, Herd $herd) {
        
    }

    public function setGameRulesDispatcher(GameRulesDispatcher $dispatcher) {
        $this->gameRulesDispatcher = $dispatcher;
    }

}
