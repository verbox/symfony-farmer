<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\GameRules;

/**
 * Description of RulesActionBuilderFactory
 *
 * @author learning
 */
class RulesActionBuilderFactory {
    public static function getBuilder(string $name) : RulesActionBuilder {
        if ($name == "basic") {
            return new BasicRulesActionBuilder();
        }
        throw new Exception("BŁAD Z TWORZENIEM ZASAD");
    }
}
