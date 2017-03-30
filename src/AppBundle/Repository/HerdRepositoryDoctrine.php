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
    
    private function getFarmAnimals() : array {
        $query = $this->getOrm()->createQuery(
                'SELECT a'
                . ' FROM AppBundle:AnimalType a'
                . ' WHERE a.kind IN (:kinds)'
                )->setParameter('kinds', AnimalType::FARM_ANIMALS_KIND);
        return $query->getResult();
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
        $this->addNewHerdAllEntries($newHerd);
    }
    
    private function addNewHerdAllEntries(Herd $newHerd) {
        $this->getOrm()->beginTransaction();
        foreach($this->getFarmAnimals() as $animal) {
            $herdEntry = new HerdEntry($animal, 0);
            $herdEntry->setHerd($newHerd);
            $this->getOrm()->persist($herdEntry);
        }
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

    public function getHerdEntry(int $id) {
        $herdEntryEntityRepository = $this->getOrm()->getRepository($this->herdEntryRepositoryName);
        return $herdEntryEntityRepository->find($id);
    }

    public function removeAnimalsFromHerd(Herd $herd, AnimalType $animal, int $count): bool {
        $entry = $this->getEntry($herd, $animal);
        if (!$entry) {
            throw new \Exception("Proba usuniecia zwierzecia, ktorego nie ma w stadzie.");
        }
        $entryCount = $entry->getCount();
        //remove
        $newCount = $entryCount - $count;
        if ($newCount >= 0) {
            $entry->setCount($newCount);
            $this->updateEntry($entry);
            return true;
        }
        if ($newCount < 0) {
            throw new \Exception("Proba usuniecia wiekszej liczby zwierzat niz mozna");
        }
        return false;
    }
    
    public function removeAllAnimals(Herd $herd, AnimalType $animal) {
        $entry = $this->getEntry($herd, $animal);
        if (!$entry) {
            throw new \Exception("Proba usuniecia zwierzecia, ktorego nie ma w stadzie.");
        }
        $entryCount = $entry->getCount();
        $this->removeAnimalsFromHerd($herd, $animal, $entryCount);
    }

}
