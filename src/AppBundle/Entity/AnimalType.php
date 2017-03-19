<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Description of Animal
 * @ORM\Entity
 * @ORM\Table(name="animal_types")
 * @author learning
 */
class AnimalType {
    
     /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var long 
     */
    protected $id;
    
    /**
     * @ORM\Column(type="string")
     * @var string
     */
    private $name;
    
    /**
     * @ORM\Column(type="string")
     */
    private $kind;
    
//    /**
//     * @ORM\
//     */
//    private $
    
}
