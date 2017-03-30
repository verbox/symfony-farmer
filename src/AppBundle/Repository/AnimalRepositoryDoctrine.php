<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Repository;

use AppBundle\Repository\Interfaces\AnimalRepository;
use AppBundle\Repository\Interfaces\DoctrineRepository;
use Doctrine\ORM\EntityManager;

/**
 * Description of AnimalRepositoryDoctrine
 *
 * @author learning
 */
class AnimalRepositoryDoctrine extends DoctrineRepository implements AnimalRepository{    
    function __construct(EntityManager $orm) {
        parent::__construct('AppBundle:AnimalType',$orm);
    }

    public function getAnimalTypeByName(string $animalName) {
        return $this->getEntityRepository->findOneByName($animalName);
    }

}
