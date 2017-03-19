<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Repository;

use AppBundle\Entity\Herd;
use AppBundle\Entity\User;
use AppBundle\Repository\Interfaces\HerdRepository;
use Doctrine\ORM\EntityManager;

/**
 * Description of HerdRepository
 *
 * @author learning
 */
class HerdRepositoryDoctrine implements HerdRepository {
    private $orm;
    
    function __construct(EntityManager $orm) {
        $this->orm = $orm;
    }
    
    function getOrm() {
        return $this->orm;
    }

    public function addAnimalsToHerd(Herd $herd, array $animal, int $count) {
        
    }

    public function addNewHerd(User $user, Herd $newHerd) {
        $this->orm->beginTransaction();
        $newHerd->setUser($user);
        $this->orm->persist($newHerd);
        $this->orm->flush();
        $this->orm->commit();
    }

}
