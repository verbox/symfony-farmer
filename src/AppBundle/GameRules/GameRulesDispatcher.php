<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\GameRules;

use AppBundle\GameRules\ActionInterfaces\ExchangeAction;
use AppBundle\GameRules\ActionInterfaces\ReproduceAction;
use AppBundle\GameRules\ActionInterfaces\RollDiceAction;
use AppBundle\Repository\Interfaces\AnimalRepository;
use AppBundle\Repository\Interfaces\DiceRepository;
use AppBundle\Repository\Interfaces\ExchangeRepository;
use AppBundle\Repository\Interfaces\HerdRepository;
use AppBundle\Repository\RepositoryContext;

/**
 * Description of GameRulesDispatcher
 *
 * @author learning
 */
class GameRulesDispatcher {
    /**
     *
     * @var RollDiceAction
     */
    private $rollDiceAction;
    
    /**
     *
     * @var ReproduceAction
     */
    private $reproduceAction;
    
    /**
     *
     * @var ExchangeAction
     */
    private $exchangeAction;
    
    /**
     *
     * @var RepositoryContext
     */
    private $repositoryContext;
    
    public function __construct(string $rulesName, RepositoryContext $repositoryContext)
    {
        $builder = RulesActionBuilderFactory::getBuilder($rulesName);
        $this->repositoryContext = $repositoryContext;
        /*
         * build actions
         */
        //roll dice action
        $this->rollDiceAction = $builder->createRollDiceAction();
        $this->getRollDiceAction()->setGameRulesDispatcher($this);
        //reproduce action
        $this->reproduceAction = $builder->createReproduceAction();
        $this->getReproduceAction()->setGameRulesDispatcher($this);
        //exchange action
        $this->exchangeAction = $builder->createExchangeAction();
        $this->getExchangeAction()->setGameRulesDispatcher($this);
    }
    
    public function getRollDiceAction(): RollDiceAction {
        return $this->rollDiceAction;
    }

    public function getReproduceAction(): ReproduceAction {
        return $this->reproduceAction;
    }
    
    public function getExchangeAction(): ExchangeAction {
        return $this->exchangeAction;
    }

        
    /* REPOSITORIES */
    function getHerdRepository(): HerdRepository {
        return $this->repositoryContext->getHerdRepository();
    }

    function getAnimalRepository(): AnimalRepository {
        return $this->repositoryContext->getAnimalRepository();
    }

    function getDiceRepository(): DiceRepository {
        return $this->repositoryContext->getDiceRepository();
    }
    
    function getExchangeRepository(): ExchangeRepository {
        return $this->repositoryContext->getExchangeRepository();
    } 
}
