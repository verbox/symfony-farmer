<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Entity;

use AppBundle\Model\Herd\InternHerdState;
use AppBundle\Model\Herd\PackableHerd;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\PersistentCollection;
/**
 * Description of Herd
 * @ORM\Entity
 * @ORM\Table(name="herds")
 * @author learning
 */
class Herd implements PackableHerd{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\OneToOne(targetEntity="User", inversedBy="herd")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * @var type 
     */
    private $user;
    
    /**
     * @ORM\OneToMany(targetEntity="HerdEntry",mappedBy="herd")
     * @var type 
     */
    private $animalEntries;
    
    function __construct() {
        $this->animalEntries = new ArrayCollection();
    }
    
    function getUser(): User {
        return $this->user;
    }

    function getAnimalEntries(): PersistentCollection {
        return $this->animalEntries;
    }

    function setUser(User $user) {
        $this->user = $user;
    }

    function setAnimalEntries(PersistentCollection $animalEntries) {
        $this->animalEntries = $animalEntries;
    }

    public function getInternState(): InternHerdState {
        $herdState = new InternHerdState();
        foreach($this->animalEntries->toArray() as $entry)
        {
            $herdState->addAnimal($entry->getAnimalObj(),$entry->getCount());
        }
        return $herdState;
    }

}
