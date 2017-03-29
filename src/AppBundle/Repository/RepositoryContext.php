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
    
    public function __construct(Interfaces\AnimalRepository $animalRepository, Interfaces\DiceRepository $diceRepository, Interfaces\HerdRepository $herdRepository) {
        $this->animalRepository = $animalRepository;
        $this->diceRepository = $diceRepository;
        $this->herdRepository = $herdRepository;
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



}
