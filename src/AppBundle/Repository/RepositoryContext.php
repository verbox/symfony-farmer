<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Repository;

/**
 * Description of RepositoryContext
 *
 * @author learning
 */
class RepositoryContext {
    /**
     *
     * @var Interfaces\AnimalRepository
     */
    private $animalRepository;
    
    /**
     *
     * @var Interfaces\DiceRepository
     */
    private $diceRepository;
    
    /**
     *
     * @var Interfaces\HerdRepository
     */
    private $herdRepository;
    
    /**
     *
     * @var Interfaces\ExchangeRepository
     */
    private $exchangeRepository;
    
    public function __construct(Interfaces\AnimalRepository $animalRepository, Interfaces\DiceRepository $diceRepository, Interfaces\HerdRepository $herdRepository, Interfaces\ExchangeRepository $exchangeRepository) {
        $this->animalRepository = $animalRepository;
        $this->diceRepository = $diceRepository;
        $this->herdRepository = $herdRepository;
        $this->exchangeRepository = $exchangeRepository;
    }
    
    public function getAnimalRepository(): Interfaces\AnimalRepository {
        return $this->animalRepository;
    }

    public function getDiceRepository(): Interfaces\DiceRepository {
        return $this->diceRepository;
    }

    public function getHerdRepository(): Interfaces\HerdRepository {
        return $this->herdRepository;
    }

    public function getExchangeRepository(): Interfaces\ExchangeRepository {
        return $this->exchangeRepository;
    }

}
