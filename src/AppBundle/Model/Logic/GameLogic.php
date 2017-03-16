<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Model\Logic;

/**
 *
 * @author pj
 */
interface GameLogic {

    public function setPackableHerd(\AppBundle\Model\Herd\PackableHerd $herd);

    public function addAnimalsToPackable(\AppBundle\Model\Animal\AbstractAnimal $animal, int $count);

    public function reproduce(\AppBundle\Model\Animal\AbstractAnimal... $animals);

    public function exchangeUnit(\AppBundle\Model\Animal\AbstractAnimal $firstAnimal, \AppBundle\Model\Animal\AbstractAnimal $secondAnimal);

    public function attack(\AppBundle\Model\Animal\AbstractAnimal $animal);
}
