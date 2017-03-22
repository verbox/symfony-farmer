<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NiceRollDiceView
 *
 * @author learning
 */
class NiceRollDiceView {
    
    private $rollDice;
    private $animalNames;
    
    function __construct($rollDice, $animalNames) {
        $this->rollDice = $rollDice;
        $this->animalNames = $animalNames;
    }

    
    function getRollDice() {
        return $this->rollDice;
    }

    function getAnimalNames() {
        return $this->animalNames;
    }

    function setRollDice($rollDice) {
        $this->rollDice = $rollDice;
    }

    function setAnimalNames($animalNames) {
        $this->animalNames = $animalNames;
    }


}
