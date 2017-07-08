<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Payment;
use AppBundle\Entity\Transaction;
use Doctrine\ORM\EntityRepository;

class PaymentRepository extends EntityRepository
{

    public function findAllPaymentMethodsOrderedByName()
    {
        return $this->createQueryBuilder('payment')
            ->orderBy('payment.name', 'ASC');
    }

    public function findAllPaymentMethods()
    {
        return $this->createQueryBuilder('payment')
            ->getQuery()
            ->execute();
    }

}
