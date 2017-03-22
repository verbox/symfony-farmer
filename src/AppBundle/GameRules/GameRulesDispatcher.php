<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\GameRules;

/**
 * Description of GameRulesDispatcher
 *
 * @author learning
 */
class GameRulesDispatcher {
    /**
     *
     * @var ActionInterfaces\RollDiceAction
     */
    private $rollDiceAction;
    
    /**
     *
     * @var ActionInterfaces\ReproduceAction
     */
    private $reproduceAction;
    
    /**
     *
     * @var \AppBundle\Repository\Interfaces\HerdRepository
     */
    private $herdRepository;
    
    /**
     *
     * @var \AppBundle\Repository\Interfaces\AnimalRepository
     */
    private $animalRepository;
    
    /**
     *
     * @var \AppBundle\Repository\Interfaces\DiceRepository
     */
    private $diceRepository;
    
    public function __construct(string $rulesName)
    {
        $builder = RulesActionBuilderFactory::getBuilder($rulesName);
        /*
         * build actions
         */
        //roll dice action
        $this->setRollDiceAction($builder->createRollDiceAction());
        $this->getRollDiceAction()->setGameRulesDispatcher($this);
        //reproduce action
        $this->setReproduceAction($builder->createReproduceAction());
        $this->getReproduceAction()->setGameRulesDispatcher($this);
    }
    
    public function getRollDiceAction(): ActionInterfaces\RollDiceAction {
        return $this->rollDiceAction;
    }

    public function getReproduceAction(): ActionInterfaces\ReproduceAction {
        return $this->reproduceAction;
    }

    private function setRollDiceAction(ActionInterfaces\RollDiceAction $rollDiceAction) {
        $this->rollDiceAction = $rollDiceAction;
    }

    private function setReproduceAction(ActionInterfaces\ReproduceAction $reproduceAction) {
        $this->reproduceAction = $reproduceAction;
    }
    
    function getHerdRepository(): \AppBundle\Repository\Interfaces\HerdRepository {
        return $this->herdRepository;
    }

    function getAnimalRepository(): \AppBundle\Repository\Interfaces\AnimalRepository {
        return $this->animalRepository;
    }

    function getDiceRepository(): \AppBundle\Repository\Interfaces\DiceRepository {
        return $this->diceRepository;
    }

    function setHerdRepository(\AppBundle\Repository\Interfaces\HerdRepository $herdRepository) {
        $this->herdRepository = $herdRepository;
    }

    function setAnimalRepository(\AppBundle\Repository\Interfaces\AnimalRepository $animalRepository) {
        $this->animalRepository = $animalRepository;
    }

    function setDiceRepository(\AppBundle\Repository\Interfaces\DiceRepository $diceRepository) {
        $this->diceRepository = $diceRepository;
    }


    



    
    
}
