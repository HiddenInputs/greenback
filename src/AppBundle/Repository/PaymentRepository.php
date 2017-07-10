<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Payment;
use AppBundle\Entity\Transaction;
use AppBundle\Entity\User;
use Doctrine\ORM\EntityRepository;

class PaymentRepository extends EntityRepository
{

    /**
     * @param User $user
     * @return Payment[]
     */
    public function findAllPaymentMethodsOrderedByName(User $user)
    {
        return $this->createQueryBuilder('payment')
            ->andWhere('payment.user = :user')
            ->orderBy('payment.name', 'ASC')
            ->setParameter('user',$user)
            ->getQuery()
            ->execute();
    }

}
