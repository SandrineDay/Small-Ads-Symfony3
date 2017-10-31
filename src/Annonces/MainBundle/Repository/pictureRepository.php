<?php

namespace Annonces\MainBundle\Repository;

/**
 * pictureRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class pictureRepository extends \Doctrine\ORM\EntityRepository
{
    public function findAllPictures(){
        return $this->getEntityManager()
            ->createQuery(
                'SELECT p FROM AnnoncesMainBundle:picture p'
            )
            ->getResult();
    }
}
