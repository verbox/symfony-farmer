<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\GameRules\BasicGameRules;

use AppBundle\Entity\Herd;
use AppBundle\GameRules\ActionInterfaces\ReproduceAction;
use AppBundle\GameRules\GameRulesDispatcher;

/**
 * Description of BasicReproduceAction
 *
 * @author learning
 */
class BasicReproduceAction implements ReproduceAction{
    /**
     *
     * @var GameRulesDispatcher
     */
    private $dispatcher;
    
    public function reproduceAnimals(Herd $herd, array $animalTypes) {
        //get herd reposytory
        $herdRepository = $this->dispatcher->getHerdRepository();
        
        assert(count($animalTypes)==2);
        //get animals
        $firstAnimal = $animalTypes[0];
        //get second animals
        $secondAnimal = $animalTypes[1];
        //if equals
        if ($firstAnimal==$secondAnimal) {
            //make new animal and add to herd
            $herdRepository->addAnimalsToHerd($herd, $firstAnimal, 1);
        }
        else {
            foreach($animalTypes as $animalType) {
                $count = $herdRepository->getCount($herd, $animalType)+1;
                $pairCount = round($count/2,0,PHP_ROUND_HALF_DOWN);
                if ($pairCount>0) {
                    $herdRepository->addAnimalsToHerd($herd, $animalType, $pairCount);
                }
            }
        }
            
            
    }

    public function setGameRulesDispatcher(GameRulesDispatcher $dispatcher) {
        $this->dispatcher = $dispatcher;
    }

    public function getGameRulesDispatcher(): GameRulesDispatcher {
        return $this->dispatcher();
    }

}
