<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Repository;

use AppBundle\Entity\AnimalType;
use AppBundle\Entity\Herd;
use AppBundle\Entity\HerdEntry;
use AppBundle\Entity\User;
use AppBundle\Repository\Interfaces\DoctrineRepository;
use AppBundle\Repository\Interfaces\HerdRepository;
use Doctrine\ORM\EntityManager;

/**
 * Description of HerdRepository
 *
 * @author learning
 */
class HerdRepositoryDoctrine extends DoctrineRepository implements HerdRepository {
    private $herdEntryRepositoryName;
    
    function __construct(EntityManager $orm) {
        parent::__construct('AppBundle:Herd', $orm);
        $this->herdEntryRepositoryName = 'AppBundle:HerdEntry';
    }

    public function addAnimalsToHerd(Herd $herd, AnimalType $animal, int $count) {
        $entry = $this->getEntry($herd, $animal);
        if ($entry) {
            $newCount = $entry->getCount();
            $newCount += $count;
            $entry->setCount($newCount);
            $this->updateEntry($entry);
        }
        else {
            //create new HerdEntry
            $entry = new HerdEntry($animal, $count);
            $this->addEntry($herd, $entry);
        }
    }
    
    private function getEntry(Herd $herd, AnimalType $animal) {
        $animalId = $animal->getId();
        $herdId = $herd->getId();
        $query = $this->getOrm()->createQuery(
                'SELECT e'
                . ' FROM AppBundle:HerdEntry e'
                . ' WHERE e.herd = :givenH'
                . ' AND e.animalType = :givenA'
                )->setParameter('givenH',$herd
                )->setParameter('givenA',$animal);
        return $query->setMaxResults(1)->getOneOrNullResult();
    }
    
    public function getCount(Herd $herd, AnimalType $animal) : int{
        $entry = $this->getEntry($herd, $animal);
        if ($entry) {
            return $entry->getCount();
        }
        else {
            return 0;
        }
    }

    public function addNewHerd(User $user, Herd $newHerd) {
        $this->getOrm()->beginTransaction();
        $newHerd->setUser($user);
        $this->getOrm()->persist($newHerd);
        $this->getOrm()->flush();
        $this->getOrm()->commit();
    }
    
    private function updateEntry(HerdEntry $entry) {
        $this->getOrm()->beginTransaction();
        $this->getOrm()->flush();
        $this->getOrm()->commit();
    }
    
    private function addEntry(Herd $herd, HerdEntry $entry) {
        $this->getOrm()->beginTransaction();
        $entry->setHerd($herd);
        $this->getOrm()->persist($entry);
        $this->getOrm()->flush();
        $this->getOrm()->commit();
    }

    public function getExchangeOptionsForHerdEntry(HerdEntry $herdEntry): array {
        $query = $this->getOrm()->createQuery(
                'SELECT exentry'
                . ' FROM AppBundle:ExchangeEntry exentry'
                . ' WHERE (exentry.firstAnimal = :animal'
                . ' AND exentry.firstCount <= :count)'
                . ' OR (exentry.secondAnimal = :animal'
                . ' AND exentry.secondCount <= :count)'
                )->setParameter('animal',$herdEntry->getAnimalType()
                )->setParameter('count',$herdEntry->getCount());
        $result = $query->getResult();
        return $result;
    }

}
