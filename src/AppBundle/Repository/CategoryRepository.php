<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class CategoryRepository extends EntityRepository
{
    public function findAllCategoriesOrderedByName()
    {
        return $this->createQueryBuilder('category')
            ->orderBy('category.name', 'ASC');
    }
}
