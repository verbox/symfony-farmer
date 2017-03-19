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

/**
 * Description of HerdController
 *
 * @author learning
 */
class HerdController extends Controller{
    
    /**
     * @Route("/", name="index_action")
     * @return typ
     */
    public function helloAction()
    {
        $user = NULL;
        $animalEntries = NULL;
        $herd = NULL;
        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY'))
        {
            $user = $this->getUser();
            if ($user->isHerdCreated()) {
                $herd = $user->getHerd();
                $animalEntries = $herd ->getAnimalEntries();
            }
        }
        
        return $this->render('farmer/index.html.twig',array(
            'user' => $user, 'animal_entries' => $animalEntries,
            'herd' => $herd,
        ));
    }
    
    /**
     * @Route("/rollDice/history",name="roll_dice_history")
     * @Security("has_role('ROLE_USER')")
     */
    public function rollDiceHistoryAction()
    {
        $user = $this->getUser();
        $herd = $user->getHerd();
        $roll_dices = $herd->getRollDiceActions()->toArray();
        return $this->render('farmer/roll_dice_history.html.twig', array('rdh' => $roll_dices));
    }
    
    /**
     * @Route("/rollDice/new",name="roll_dice")
     * @Security("has_role('ROLE_USER')")
     */
    public function rollDiceAction() {
        $user = $this->getUser();
        $herd = $user->getHerd();
        $em = $this->getDoctrine()->getManager();
        
        $rollDice = new RollDice(SimpleAnimalFactory::getInstance()->randomAnimals(2),$herd);
        $em->persist($rollDice);
        $em->flush();
        //$user->getHerd()->addAnimals("Rabbit",3,$em);
        return $this->redirectToRoute("roll_dice_history");
    }
    

}
