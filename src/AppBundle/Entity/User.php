<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
/**
 * Description of User
 *
 * @ORM\Entity
 * @ORM\Table(name="users")
 * @author learning
 */
class User extends BaseUser {
   
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var long 
     */
    protected $id;
   
    /**
     * @ORM\OneToOne(targetEntity="Herd", mappedBy="user")
     * @var Herd
     */
    private $herd;
    
    function __construct() {
        parent::__construct();
    }
    
    function getId(): int {
        return $this->id;
    }
    
    function getHerd(): Herd {
        return $this->herd;
    }

    function setHerd(Herd $herd) {
        $this->herd = $herd;
    }



}
