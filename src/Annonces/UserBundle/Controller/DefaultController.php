<?php

namespace Annonces\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('AnnoncesMainBundle:Default:espaceperso.html.twig');
    }
}
