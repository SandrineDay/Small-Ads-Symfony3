<?php

namespace Annonces\UserBundle\Controller;

use Annonces\UserBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction(User $user)
    {
        return $this->render('AnnoncesMainBundle:Default:espaceperso.html.twig');
    }


}
