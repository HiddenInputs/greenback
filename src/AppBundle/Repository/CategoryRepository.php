<?php

namespace AppBundle\Repository;

use AppBundle\Entity\User;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping;

class CategoryRepository extends EntityRepository
{

    public function findAllCategoriesOrderedByName(User $user)
    {
        return $this->createQueryBuilder('category')
            ->andWhere('category.user = :user')
            ->orderBy('category.name', 'ASC')
            ->setParameter('user', $user);

    }

//    /**
//     * @param $user
//     * @return \Doctrine\ORM\QueryBuilder
//     */
//    public function findAllCategoriesOrderedByName($user)
//    {
//        return $this->createQueryBuilder('category')
//            ->andWhere('category.user = :user')
//            ->orderBy('category.name', 'ASC')
//            ->setParameter('user', $user);
//
//    }


}
