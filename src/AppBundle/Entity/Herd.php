<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Entity;

use AppBundle\Model\Herd\InternHerdState;
use AppBundle\Model\Herd\PackableHerd;
use AppBundle\Model\Animal;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\PersistentCollection;
use Doctrine\Common\Collections\Criteria;
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
     * @ORM\OneToMany(targetEntity="HerdEntry",mappedBy="herd", cascade={"persist","remove"})
     * @var type 
     */
    private $animalEntries;
    
    /**
     * @ORM\OneToMany(targetEntity="RollDice",mappedBy="herd",cascade={"persist","remove"})
     */
    private $rollDiceActions;
    
    /**
     * @ORM\Column(type="string",name="name")
     */
    private $name;
    
    function getName() {
        return $this->name;
    }

    function setName($name) {
        $this->name = $name;
    }

    function __construct() {
        $this->animalEntries = new ArrayCollection();
        $this->rollDiceActions = new ArrayCollection();
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
    
    public function addAnimals(string $animalName, int $animalCount, \Doctrine\ORM\EntityManager $em) {
        if (Animal\SimpleAnimalFactory::getInstance()->isValidAnimalName($animalName))
        {
            //try to find entry
            foreach($this->animalEntries->toArray() as $entry)
            {
                if ($entry->getAnimal()==$animalName) {
                    $count = $entry->getCount();
                    $count+=$animalCount;
                    $entry->setCount($count);
                    $em->flush();
                    return;
                }
            }
            
            //create new entry
            $newEntry = new HerdEntry(Animal\SimpleAnimalFactory::getInstance()->createAnimal($animalName), $animalCount);
            $newEntry->setHerd($this);
            $this->animalEntries->add($newEntry);
            $em->persist($newEntry);
            $em->flush();

        }
        else
        {
            throw new \Exception("BLAD");
        }
    }
    
    function getRollDiceActions() {
        return $this->rollDiceActions;
    }

    function setRollDiceActions($rollDiceActions) {
        $this->rollDiceActions = $rollDiceActions;
    }



}
