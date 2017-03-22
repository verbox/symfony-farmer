<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;

/**
 * Description of RollDice
 *
 * Description of Herd
 * @ORM\Entity
 * @ORM\Table(name="roll_dices")
 * @author learning
 */
class RollDice {
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\ManyToMany(targetEntity="DiceSide")
     * @ORM\JoinTable(name="roll_dices_sides",
     *  joinColumns={@JoinColumn(name="roll_dice_id", referencedColumnName="id")},
     *  inverseJoinColumns={@JoinColumn(name="dice_side_id",referencedColumnName="id")}
     * )
     */
    private $diceSides;
    
    /**
     * @ORM\Column(type="datetime")
     */
    private $time;
    
    /**
     * @ORM\ManyToOne(targetEntity="Herd", inversedBy="rollDices")
     * @ORM\JoinColumn(name="herd_id", referencedColumnName = "id")
     */
    private $herd;   
    
    function __construct(array $diceSides, Herd $herd) {
        $this->time = new DateTime();
        $this->diceSides = new ArrayCollection();
        foreach($diceSides as $diceSide)
        {
            $this->diceSides->add($diceSide);
        }
        $this->herd = $herd;
    }
    
    function getId() {
        return $this->id;
    }

    function getDiceSides() {
        return $this->diceSides;
    }

    function getTime() {
        return $this->time;
    }

    function getHerd() {
        return $this->herd;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setDiceSides($diceSides) {
        $this->diceSides = $diceSides;
    }

    function setTime($time) {
        $this->time = $time;
    }

    function setHerd($herd) {
        $this->herd = $herd;
    }






}
