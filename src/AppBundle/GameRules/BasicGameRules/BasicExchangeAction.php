<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\GameRules\BasicGameRules;

use AppBundle\Entity\ExchangeEntry;
use AppBundle\Entity\Herd;
use AppBundle\Entity\HerdEntry;
use AppBundle\Entity\User;
use AppBundle\GameRules\ActionInterfaces\ExchangeAction;
use AppBundle\GameRules\GameRulesDispatcher;
use AppBundle\Model\FixedExchangeEntry;

/**
 * Description of BasicExchangeAction
 *
 * @author learning
 */
class BasicExchangeAction implements ExchangeAction {

    private $dispatcher;
    public function exchangeAnimals(User $user, Herd $herd, HerdEntry $herdEntry, ExchangeEntry $exchangeEntry): bool {
        //only exchange at this moment
        //get fixed exchange entry - first animal is always our animals, second is animal which we want
        $fixedExchangeEntry = new FixedExchangeEntry($exchangeEntry, $herdEntry);
        //so, we remove my animals
        $herdRepository = $this->getGameRulesDispatcher()->getHerdRepository();
        $removedAnimal = $fixedExchangeEntry->getMyAnimal();
        $removedAnimalCount = $fixedExchangeEntry->getMyAnimalCount();
        $herdRepository->removeAnimalsFromHerd($herd, $removedAnimal, $removedAnimalCount);
        //and add wanted animals
        $wantedAnimal = $fixedExchangeEntry->getOtherAnimal();
        $wantedAnimalCount = $fixedExchangeEntry->getOtherAnimalCount();
        $herdRepository->addAnimalsToHerd($herd, $wantedAnimal, $wantedAnimalCount);
        //add history
        $exchangeHistoryEntry = new \AppBundle\Entity\ExchangeEntryAction($herdEntry,$exchangeEntry);
        $exchangeRepository = $this->getGameRulesDispatcher()->getExchangeRepository();
        $exchangeRepository->addExchangeEntryAction($exchangeHistoryEntry);
        //its all
        return true;
    }

    public function getGameRulesDispatcher(): GameRulesDispatcher {
        return $this->dispatcher;
    }

    public function setGameRulesDispatcher(GameRulesDispatcher $dispatcher) {
        $this->dispatcher = $dispatcher;
    }

}
