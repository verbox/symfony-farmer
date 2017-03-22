<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\GameRules\ActionInterfaces;

use AppBundle\Entity\Herd;
use AppBundle\Entity\RollDice;

/**
 *
 * @author learning
 */
interface RollDiceAction extends BasicAction{
    
    public function rollDiceInHerd(RollDice $rollDices, Herd $herd);
    public function doRollDice(string $type);
}
