<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\GameRules\ActionInterfaces;

/**
 * Description of ExchangeAction
 *
 * @author learning
 */
interface ExchangeAction extends BasicAction{
    public function exchangeAnimals(\AppBundle\Entity\User $user, \AppBundle\Entity\Herd $herd, 
    AppBundle\Entity\HerdEntry $herdEntry, \AppBundle\Model\Logic\ExchangeEntry $exchangeEntry) : bool;
}
