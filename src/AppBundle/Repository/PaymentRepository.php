<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class PaymentRepository extends EntityRepository
{
    public function findAllPaymentMethodsOrderedByName()
    {
        return $this->createQueryBuilder('payment')
            ->orderBy('payment.name', 'ASC');
    }
}
