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
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\PersistentCollection;

/**
 * Description of Herd
 * @ORM\Entity
 * @ORM\Table(name="herds")
 * @author learning
 */
class Herd implements PackableHerd {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    function getId() {
        return $this->id;
    }

    /**
     * @ORM\OneToOne(targetEntity="User", inversedBy="herd")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * @var type 
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity="HerdEntry",mappedBy="herd", cascade={"persist","remove"})
     * @ORM\OrderBy({"id"="ASC"})
     * @var type 
     */
    private $animalEntries;

    /**
     * @ORM\OneToMany(targetEntity="RollDice",mappedBy="herd",cascade={"persist","remove"})
     */
    private $rollDices;

    /**
     * @ORM\Column(type="string",name="name")
     */
    private $name;

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function __construct() {
        $this->animalEntries = new ArrayCollection();
        $this->rollDices = new ArrayCollection();
    }

    public function getUser(): User {
        return $this->user;
    }

    public function getAnimalEntries(): Collection {
        return $this->animalEntries;
    }
    
    public function getNotEmptyAnimalEntries(): Collection {
        $criteria = Criteria::create()
                ->where(Criteria::expr()->neq("count", 0));
        return $this->animalEntries->matching($criteria);
    }

    public function setUser(User $user) {
        $this->user = $user;
    }

    public function setAnimalEntries(PersistentCollection $animalEntries) {
        $this->animalEntries = $animalEntries;
    }

    public function getInternState(): InternHerdState {
        $herdState = new InternHerdState();
        foreach ($this->animalEntries->toArray() as $entry) {
            $herdState->addAnimal($entry->getAnimalObj(), $entry->getCount());
        }
        return $herdState;
    }

//    public function hasEntry(AnimalType $animalName): bool {
//        return $this->animalEntries->
//        return false;
//    }
//
//    public function countAnimal(string $animalName): int {
//        if (!$this->hasEntry($animalName)) {
//            return 0;
//        } else {
//            $entry = $this->getEntry($animalName);
//            return $entry->getCount();
//        }
//    }
//
//    public function getEntry(string $animalName): HerdEntry {
//        if (Animal\SimpleAnimalFactory::getInstance()->isValidAnimalName($animalName)) {
//            //try to find entry
//            foreach ($this->animalEntries->toArray() as $entry) {
//                if ($entry->getAnimalName() == $animalName) {
//                    return $entry;
//                }
//            }
//        }
//        throw new \Exception("Błąd przy pobieraniu zwierzaków.");
//    }
//
//    public function addAnimals(string $animalName, int $animalCount, \Doctrine\ORM\EntityManager $em) {
//        
//    }
//
//    public function reproduce(\Doctrine\ORM\EntityManager $em, string... $animals) {
//        /* TODO: this must be refactorized */
//        if ($animals[0] == $animals[1]) {
//            $this->addAnimals($animals[0], 1, $em);
//        } else {
//            foreach ($animals as $animal) {
//                $pairsCount = round((($this->countAnimal($animal) + 1) / 2), 0, PHP_ROUND_HALF_DOWN);
//                if ($pairsCount > 0) {
//                    $this->addAnimals($animal, $pairsCount, $em);
//                }
//            }
//        }
//    }

    function getRollDices() {
        return $this->rollDices;
    }

    function setRollDices($rollDices) {
        $this->rollDices = $rollDices;
    }



}
