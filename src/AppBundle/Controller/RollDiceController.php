<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Controller;

use AppBundle\Entity\RollDice;
use AppBundle\Model\Animal\SimpleAnimalFactory;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
/**
 * Description of RollDiceController
 *
 * @author learning
 */
class RollDiceController extends Controller {
    /**
     * @Route("/rollDice/history",name="roll_dice_history")
     * @Security("has_role('ROLE_USER')")
     */
    public function rollDiceHistoryAction(Request $request)
    {
        $user = $this->getUser();
        $roll_dices = array();
        if ($user->isHerdCreated()) 
        {
            $herd = $user->getHerd();
            $roll_dices = $herd->getRollDiceActions()->toArray();
        }
        return $this->render('farmer/roll_dices/roll_dice_history.html.twig', array('rdh' => $roll_dices));
    }
    
    /**
     * @Route("/rollDice/new",name="roll_dice")
     * @Security("has_role('ROLE_USER')")
     */
    public function rollDiceAction(Request $request) {
        if ($this->getUser()->canRollDice()) {
            $user = $this->getUser();
            $herd = $user->getHerd();
            $em = $this->getDoctrine()->getManager();

            $rollDice = new RollDice(SimpleAnimalFactory::getInstance()->randomAnimals(2),$herd);
            $em->persist($rollDice);
            $em->flush();
            //$user->getHerd()->addAnimals("Rabbit",3,$em);
            
        }
        else {
            $this->addFlash('error', 'Nie możesz rzucić kostką');
        }
        return $this->redirectToRoute("roll_dice_history");
    }
}