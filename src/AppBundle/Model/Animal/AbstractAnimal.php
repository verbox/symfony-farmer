<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Model\Animal;

/**
 * Description of AbstractAnimal
 *
 * @author pj
 */
abstract class AbstractAnimal {

    abstract public function getKind(): string;

    public function __toString(): string {
        return $this->getKind();
    }

    public function equalsKind(AbstractAnimal $other): bool {
        return strcmp($this->getKind(), $other->getKind()) == 0;
    }

    public function saveIfExists(): array {
        
    }

    public function killOnly(): array {
        return array();
    }

    public function killExcept(): array {
        return array();
    }

}
