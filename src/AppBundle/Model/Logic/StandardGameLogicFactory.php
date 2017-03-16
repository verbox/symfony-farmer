<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Model\Logic;

/**
 * Description of StandardGameLogicFactory
 *
 * @author pj
 */
class StandardGameLogicFactory {

    public function getGameRules(string $name): GameLogic {
        if (strcmp($name, "standard") == 0) {
            return new BasicGameRules;
        }
        //...different mechanics
        return new BasicGameRules;
    }

}
