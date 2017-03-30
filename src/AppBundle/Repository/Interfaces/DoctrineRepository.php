<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Repository\Interfaces;

use Doctrine\ORM\Query;

/**
 * Description of DoctrineRepository
 *
 * @author learning
 */
abstract class DoctrineRepository implements GeneralRepository{
    private $entityRepositoryName;
    private $orm;
    
    public function __construct($entityRepository, $orm) {
        $this->entityRepositoryName = $entityRepository;
        $this->orm = $orm;
    }

     public function getEntityRepository() {
        return $this->getOrm()->getRepository($this->getEntityRepositoryName());
    }
    
      public function getEntityRepositoryName() {
        return $this->entityRepositoryName;
    }

     public function getOrm() {
        return $this->orm;
    }
    
     public function getById(int $id) {
        return $this->getEntityRepository()->find($id);
    }
    
     public function getByQuery(Query $query)
    {
        return $query->getResult();
    }

     public function add($object) {
        $this->getOrm()->beginTransaction();
        $this->getOrm()->persist($object);
        $this->getOrm()->flush();
        $this->getOrm()->commit();
    }
    
     public function remove($object) {
        $this->getOrm()->beginTransaction();
        $this->getOrm()->remove($object);
        $this->getOrm()->flush();
        $this->getOrm()->commit();
    }

     public function update($object) {
        $this->getOrm()->beginTransaction();
        $this->getOrm()->flush();
        $this->getOrm()->commit();
    }
}
