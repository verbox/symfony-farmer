<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\GameRules\ActionInterfaces;

use AppBundle\Entity\ExchangeEntry;
use AppBundle\Entity\Herd;
use AppBundle\Entity\HerdEntry;
use AppBundle\Entity\User;

/**
 * Description of ExchangeAction
 *
 * @author learning
 */
interface ExchangeAction extends BasicAction{
    public function exchangeAnimals(User $user, Herd $herd, 
    HerdEntry $herdEntry, ExchangeEntry $exchangeEntry) : bool;
}
