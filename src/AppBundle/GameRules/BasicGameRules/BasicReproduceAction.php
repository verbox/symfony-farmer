<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\GameRules\BasicGameRules;

use AppBundle\Entity\Herd;
use AppBundle\GameRules\ActionInterfaces\ReproduceAction;
use AppBundle\GameRules\GameRulesDispatcher;

/**
 * Description of BasicReproduceAction
 *
 * @author learning
 */
class BasicReproduceAction implements ReproduceAction{
    
    private $dispatcher;
    
    public function reproduceAnimal(Herd $herd, array $animalTypes) {
        
    }

    public function setGameRulesDispatcher(GameRulesDispatcher $dispatcher) {
        $this->dispatcher = $dispatcher;
    }

}
