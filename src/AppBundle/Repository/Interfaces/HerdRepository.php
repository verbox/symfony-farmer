<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace AppBundle\Repository\Interfaces;

use AppBundle\Entity\AnimalType;
use AppBundle\Entity\Herd;
use AppBundle\Entity\HerdEntry;
use AppBundle\Entity\User;
/**
 * Description of HerdRepository
 *
 * @author learning
 */
interface HerdRepository{
    function addAnimalsToHerd(Herd $herd, AnimalType $animal, int $count);
    function addNewHerd(User $user, Herd $newHerd);
    function getCount(Herd $herd, AnimalType $animal) : int;
    function getExchangeOptionsForHerdEntry(HerdEntry $herdEntry) : array;
}
