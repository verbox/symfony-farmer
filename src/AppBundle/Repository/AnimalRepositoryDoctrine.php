<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Repository;

/**
 * Description of AnimalRepositoryDoctrine
 *
 * @author learning
 */
class AnimalRepositoryDoctrine extends Interfaces\DoctrineRepository implements Interfaces\AnimalRepository{
    private $orm;
    
    function __construct(EntityManager $orm) {
        parent::__construct($orm,'AppBundle:AnimalType');
    }

    public function getAnimalTypeByName(string $animalName) {
        return $this->getEntityRepository->findOneByName($animalName);
    }

}
