<?php

namespace Annonces\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class AnnoncesUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
