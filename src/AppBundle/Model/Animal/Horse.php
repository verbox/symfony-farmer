<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Model\Animal;

/**
 * Description of Horse
 *
 * @author pj
 */
class Horse extends AbstractAnimal {

    public function getKind(): string {
        return "Horse";
    }

}
