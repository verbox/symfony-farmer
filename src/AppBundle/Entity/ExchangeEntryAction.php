<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="exchange_entries_history")
 */
class ExchangeEntryAction {
    
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="HerdEntry")
     * @ORM\JoinColumn(name="herd_entry_id")
     * @var HerdEntry
     */
    private $herdEntry;
    
    /**
     * @ORM\ManyToOne(targetEntity="ExchangeEntry")
     * @ORM\JoinColumn(name="exchange_entry_id")
     * @var ExchangeEntry
     */
    private $exchangeEntry;
    
    /**
     * @ORM\Column(type="datetime")
     */
    private $time;
    
    public function __construct(HerdEntry $herdEntry, ExchangeEntry $exchangeEntry) {
        $this->herdEntry = $herdEntry;
        $this->exchangeEntry = $exchangeEntry;
        $this->time = new \DateTime();
    }
    
    public function getId() {
        return $this->id;
    }

    public function getHerdEntry(): HerdEntry {
        return $this->herdEntry;
    }

    public function getExchangeEntry(): ExchangeEntry {
        return $this->exchangeEntry;
    }

    public function getTime() {
        return $this->time;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setHerdEntry(HerdEntry $herdEntry) {
        $this->herdEntry = $herdEntry;
    }

    public function setExchangeEntry(ExchangeEntry $exchangeEntry) {
        $this->exchangeEntry = $exchangeEntry;
    }

    public function setTime($time) {
        $this->time = $time;
    }



}
