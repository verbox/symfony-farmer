<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Repository;

use AppBundle\Entity\Herd;
use AppBundle\Entity\RollDice;
use AppBundle\Repository\Interfaces\DiceRepository;
use AppBundle\Repository\Interfaces\DoctrineRepository;
use Doctrine\ORM\EntityManager;

/**
 * Description of DiceRepositoryDoctrine
 *
 * @author learning
 */
class DiceRepositoryDoctrine extends DoctrineRepository implements DiceRepository{
    
    private $diceRepositoryORM;
    
    public function __construct(EntityManager $orm) {
        parent::__construct('AppBundle:RollDice', $orm);
        $this->diceRepositoryORM = $orm->getRepository('AppBundle:Dice');
    }
    
    public function getAllDices() {
        return $this->getDiceRepository()->findAll();
    }
    
    public function getAllDicesId() : array {
        $result = array();
        foreach($this->getAllDices() as $dice) {
            $result[] = $dice->getId();
        }
        return $result;
    }
    
    public function rollAllDices(Herd $herd) {
        return $this->rollSelectedDices($this->getAllDices(), $herd);
    }

    public function rollSelectedDices(array $dices, Herd $herd) {
        $resultDiceSides = array();
        foreach($dices as $dice) {
            $diceSide = $dice->random();
            $resultDiceSides[] = $diceSide;
        }
        $rollDice = new RollDice($resultDiceSides, $herd);
        return $rollDice;
    }
    
    public function getDiceRepository() {
        return $this->diceRepositoryORM;
    }

    public function setDiceRepository($diceRepository) {
        $this->diceRepositoryORM = $diceRepository;
    }
    
    public function getAnimalsFromRollDice(RollDice $rollDice) : array {
        $animalTypes = array();
        foreach($rollDice->getAnimals() as $animalId) {
            $animal = $this->getOrm()->getRepository('AppBundle:AnimalType')->find($animalId);
            $animalTypes[] = $animal;
        }
        return $animalTypes;
    }
    
    public function getNiceRollDiceViewFromHerd(Herd $herd) : array {
        $rda = $herd->getRollDiceActions();
        $results = array();
        foreach($rda as $rd) {
            $result = new \NiceRollDiceView($rd, $this->getAnimalsFromRollDice($rd));
            $results[] = $result;
        }
        return $results;
    }


}
