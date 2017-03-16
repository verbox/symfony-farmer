<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
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
        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY'))
        {
            $user = $this->getUser();
            $herd = $user->getHerd();
            $animalEntries = $herd->getAnimalEntries();
        }
        
        return $this->render('farmer/index.html.twig',array(
            'user' => $user, 'animal_entries' => $animalEntries,
        ));
    }
}
