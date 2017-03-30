<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\GameRules;

use AppBundle\GameRules\ActionInterfaces\ExchangeAction;
use AppBundle\GameRules\ActionInterfaces\ReproduceAction;
use AppBundle\GameRules\ActionInterfaces\RollDiceAction;
use AppBundle\GameRules\BasicGameRules\BasicExchangeAction;
use AppBundle\GameRules\BasicGameRules\BasicReproduceAction;
use AppBundle\GameRules\BasicGameRules\BasicRollDiceAction;

/**
 * Description of BasicRulesActionBuilder
 *
 * @author learning
 */
class BasicRulesActionBuilder implements RulesActionBuilder{
    public function createReproduceAction(): ReproduceAction {
        return new BasicReproduceAction();
    }

    public function createRollDiceAction(): RollDiceAction {
        return new BasicRollDiceAction();
    }

    public function createExchangeAction(): ExchangeAction {
        return new BasicExchangeAction();
    }

}
