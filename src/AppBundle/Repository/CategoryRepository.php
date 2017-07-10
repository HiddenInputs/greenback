<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Category;
use AppBundle\Entity\User;
use Doctrine\ORM\EntityRepository;

class CategoryRepository extends EntityRepository
{
    /**
     * @param User $user
     * @return Category[]
     */
    public function findAllCategoriesOrderedByName(User $user)
    {
        return $this->createQueryBuilder('category')
            ->andWhere('category.user = :user')
            ->setParameter('user', $user)
            ->getQuery()
            ->execute();
    }
}

