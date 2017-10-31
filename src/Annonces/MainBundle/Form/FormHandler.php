<?php

namespace Annonces\MainBundle\Form;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;


class FormHandler
{
    private $form;
    private $request;   //super globale _REQUEST
    private $em;        //entity manager de doctrine

    public function __construct(Form $form,Request $request,EntityManager $em)
    {
        $this->form = $form;
        $this->request = $request;
        $this->em = $em;
    }

    public function process(){
        if ($this->request->getMethod() == "POST"){
            $this->form->handleRequest($this->request);
            if ($this->form->isValid() == true){
                // on persiste les données
                $this->onSuccess($this->form->getData());
                // on return true
                return true;
            }
            return false;
        }
        return false;
    }

    private function onSuccess($instance){
        $this->em->persist($instance);
        $this->em->flush();
    }

}