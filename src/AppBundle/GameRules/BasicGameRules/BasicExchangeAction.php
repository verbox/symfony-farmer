<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\GameRules\BasicGameRules;

/**
 * Description of BasicExchangeAction
 *
 * @author learning
 */
class BasicExchangeAction implements \AppBundle\GameRules\ActionInterfaces\ExchangeAction {

    private $dispatcher;
    public function exchangeAnimals(\AppBundle\Entity\User $user, \AppBundle\Entity\Herd $herd, \AppBundle\GameRules\ActionInterfaces\AppBundle\Entity\HerdEntry $herdEntry, 
            \AppBundle\Model\Logic\ExchangeEntry $exchangeEntry): bool {
        
    }

    public function getGameRulesDispatcher(): \AppBundle\GameRules\GameRulesDispatcher {
        return $this->dispatcher;
    }

    public function setGameRulesDispatcher(\AppBundle\GameRules\GameRulesDispatcher $dispatcher) {
        $this->dispatcher = $dispatcher;
    }

}
