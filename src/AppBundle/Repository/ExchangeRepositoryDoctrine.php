<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Repository;

use AppBundle\Entity\ExchangeEntryAction;
use AppBundle\Entity\HerdEntry;
use AppBundle\Repository\Interfaces\DoctrineRepository;
use AppBundle\Repository\Interfaces\ExchangeRepository;
use Doctrine\ORM\EntityManager;

/**
 * Description of ExchangeRepository
 *
 * @author learning
 */
class ExchangeRepositoryDoctrine extends DoctrineRepository implements ExchangeRepository{
    
    function __construct(EntityManager $orm) {
        parent::__construct('AppBundle:ExchangeEntry',$orm);
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

    public function addExchangeEntryAction(ExchangeEntryAction $action) {
        $this->getOrm()->beginTransaction();
        $this->getOrm()->persist($action);
        $this->getOrm()->commit();
    }

}
