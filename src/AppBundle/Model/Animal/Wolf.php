<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Model\Animal;

/**
 * Description of Wolf
 *
 * @author pj
 */
class Wolf extends AbstractAnimal {

    public function getKind(): string {
        return "Wolf";
    }

    public function saveIfExists(): array {
        return array("BigDog");
    }

    public function killOnly(): array {
        return array("ALL");
    }

    public function killExcept(): array {
        return array("Horse", "Dog");
    }

}
