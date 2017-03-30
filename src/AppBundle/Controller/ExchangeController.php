<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
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
     * @Security("has_role('ROLE_USER')")
     * @param \AppBundle\Controller\Request $request
     * @param type $herdEntryId
     * @param type $exchangeEntryId
     * @return type
     */
    public function exchangeAction(Request $request, int $herdEntryId, int $exchangeEntryId)
    {
        //checking if given herd entry is part of logged user's herd
        $user = $this->getUser();
        $herd = $user->getHerd();
        $herdRepository = $this->get("app.herd_repository");
        $repositoryContext = $this->get("app.repository_context");
        $herdEntry = $herdRepository->getHerdEntry($herdEntryId);
        $exchangeEntry = $repositoryContext->getExchangeRepository()->getById($exchangeEntryId);
        if (!$herdEntry || !$exchangeEntry || $herdEntry->getHerd()!=$herd)
        {
            
        }
        
        return $this->redirectToRoute("index_action");
    }
}
