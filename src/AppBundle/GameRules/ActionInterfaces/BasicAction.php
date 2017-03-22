<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\GameRules\ActionInterfaces;

use AppBundle\GameRules\GameRulesDispatcher;

/**
 *
 * @author learning
 */
interface BasicAction {
    public function setGameRulesDispatcher(GameRulesDispatcher $dispatcher);
    public function getGameRulesDispatcher() : GameRulesDispatcher;
}
