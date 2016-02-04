<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * ArticleRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ArticleRepository extends EntityRepository
{

    public function getLastArticles($numberOfArticles){
        return $this->findBy(
            array(),
            array('createdAt' => 'DESC'),
            $numberOfArticles,
            0
        );
    }
}
