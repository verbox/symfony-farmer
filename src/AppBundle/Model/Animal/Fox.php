<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Model\Animal;

/**
 * Description of Fox
 *
 * @author pj
 */
class Fox extends AbstractAnimal {

    public function getKind(): string {
        return "Fox";
    }

    public function saveIfExists(): array {
        return array("Dog");
    }

    public function killOnly(): array {
        return array("Rabbit");
    }

}
