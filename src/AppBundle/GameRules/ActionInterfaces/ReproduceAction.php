<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\GameRules\ActionInterfaces;

use AppBundle\Entity\Herd;

/**
 * Description of ReproduceAction
 *
 * @author learning
 */
interface ReproduceAction extends BasicAction{
    function reproduceAnimals(Herd $herd, array $animalTypes);
}
