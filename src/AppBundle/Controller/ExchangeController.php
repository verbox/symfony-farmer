<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Description of ExchangeController
 *
 * @author learning
 */
class ExchangeController extends Controller{
    
    /**
     * 
     * @Route("/exchange/{herdEntryId}/{exchangeEntryId}"
     *        ,name="exchange_action"
     *        ,requirements={
     *                      "herdEntryId":"\d+",
     *                      "exchangeEntryId":"\d+"
     *                      }
     *        )
     * 
     * @param \AppBundle\Controller\Request $request
     * @param type $herdEntryId
     * @param type $exchangeEntryId
     * @return type
     */
    public function exchangeAction(Request $request, $herdEntryId, $exchangeEntryId)
    {
        /*TODO*/
        return $this->redirectToRoute("index_action");
    }
}