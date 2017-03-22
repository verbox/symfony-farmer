<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Repository\Interfaces;

/**
 *
 * @author learning
 */
interface AnimalRepository extends GeneralRepository{
    function getAnimalTypeByName(string $animalName);
}
