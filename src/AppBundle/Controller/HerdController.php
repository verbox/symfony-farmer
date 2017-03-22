<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Herd;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

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
     * @Route("/herd/new", name="herd_new")
     * @Security("has_role('ROLE_USER')")
     */
    public function newHerdAction(Request $request) 
    {
        if(!$this->getUser()->isHerdCreated()){
        $herd = new Herd();
        $herd->setName("Wpisz tutaj nazwę swojego nowego zwierzyńca.");
        
        $form = $this->createFormBuilder($herd)
                ->add('name', TextType::class)
                ->add('save', SubmitType::class, array('label' => 'Utwórz'))
                ->getForm();
        
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $herd = $form->getData();
            $hr = $this->get('app.herd_repository');
            $hr->addNewHerd($this->getUser(),$herd);
            return $this->redirectToRoute("index_action");
        }
        
        return $this->render("farmer/herd_form.html.twig", 
                array('form' => $form->createView(),));
        }
         return $this->redirectToRoute("index_action");
    }
    
    
    

}
