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

/**
 *
 * @author learning
 */
interface RulesActionBuilder {
    public function createRollDiceAction() : RollDiceAction;
    public function createReproduceAction() : ReproduceAction;
    public function createExchangeAction(): ExchangeAction;
}
