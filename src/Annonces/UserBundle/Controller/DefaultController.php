<?php

namespace Annonces\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('AnnoncesUserBundle:Default:index.html.twig');
    }
}
