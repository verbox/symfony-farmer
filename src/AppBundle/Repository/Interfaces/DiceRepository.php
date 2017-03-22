<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Repository\Interfaces;

use AppBundle\Entity\Herd;

/**
 *
 * @author learning
 */
interface DiceRepository {
    public function rollAllDices(Herd $herd);
    public function rollSelectedDices(array $dices, Herd $herd);
}
