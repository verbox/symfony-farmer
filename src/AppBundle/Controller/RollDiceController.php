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
        $rollDices = array();
        $diceRepository = $this->get('app.dice_repository');
        if ($user->isHerdCreated()) 
        {
            $herd = $user->getHerd();
            $rollDices = $herd->getRollDices();
        }
        return $this->render('farmer/roll_dices/roll_dice_history.html.twig', array('rollDices' => $rollDices));
    }
    
    /**
     * @Route("/rollDice/new",name="roll_dice")
     * @Security("has_role('ROLE_USER')")
     */
    public function rollDiceAction(Request $request) {
        if ($this->getUser()->canRollDice()) {
            $user = $this->getUser();
            $herd = $user->getHerd();
            $game_rules = $this->get('app.game_rules');
            $diceRepository = $this->get('app.dice_repository');
            $rollDice = $diceRepository->rollAllDices($herd);
            $game_rules->getRollDiceAction()->rollDiceInHerd($rollDice,$herd);
            /* TODO refactore it, move logic to repository/logic class */
            //$user->getHerd()->reproduce($em,$rollDice->getFirstAnimal(),$rollDice->getSecondAnimal());
            //$user->getHerd()->addAnimals("Rabbit",3,$em);
            $this->addFlash('roll_msg',$this->prepareLastRollMsg($rollDice));
        }
        else {
            $this->addFlash('error', 'Nie możesz rzucić kostką');
        }
        return $this->redirectToRoute("index_action");
    }
    
    private function prepareLastRollMsg(RollDice $rollDice) 
    {
        $result = "Wylosowano ";
        //get first animal
        foreach($rollDice->getDiceSides() as $diceSide)
        {
            $result=$result.
                    \sprintf("[%s]",$diceSide->getAnimalType()->getName());
        }
        return $result;
    }
}
