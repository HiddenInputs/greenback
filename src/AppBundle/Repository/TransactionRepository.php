<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Transaction;
use AppBundle\Entity\User;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;

class TransactionRepository extends EntityRepository
{
    /**
     * @param User $user
     * @return Transaction[]
     */
    public function findAllTransactionsOrderedByCategoryName(User $user)
    {
        $qb = $this->createQueryBuilder('transaction')
            ->select(
                'transaction.id, category.name as categoryName, transaction.amount, 
                transaction.comment, payment.name as paymentMethod')
            ->andWhere('transaction.user = :user')
            ->setParameter('user', $user);
        $this->addCategoryAndPaymentJoin($qb);

        $query = $qb->getQuery();
        return  $query->execute();
    }

    /**
     * @param User $user
     * @param $from \DateTime
     * @param $to \DateTime
     * @return Transaction[]
     */
    public function findAllTransactionsBetweenSelectedDates(User $user ,$from, $to)
    {
        $qb = $this->createQueryBuilder('transaction')
            ->select(
                'transaction.id, category.name as categoryName, transaction.amount, 
                transaction.comment, payment.name as paymentMethod, transaction.createdAt')
            ->andWhere('transaction.createdAt BETWEEN :from AND :to and transaction.user = :user')
            ->setParameter('from', $from)
            ->setParameter('to', $to)
            ->setParameter('user', $user);

        $this->addCategoryAndPaymentJoin($qb);
        $query = $qb->getQuery();
        return $query->execute();
    }

    /**
     * @param User $user
     * @return Transaction[]
     */
    public function findTransactionsByLoggedUser(User $user)
    {
        $qb = $this->createQueryBuilder('transaction')
            ->andWhere('transaction.user = :user')
            ->setParameter('user', $user);

        $this->addCategoryAndPaymentJoin($qb);
        $query = $qb->getQuery();
        return $query->execute();
    }
    /**
     * @param QueryBuilder $qb
     * @return QueryBuilder
     */
    private function addCategoryAndPaymentJoin(QueryBuilder $qb)
    {
        return $qb->join('transaction.category', 'category')
            ->join('transaction.payment', 'payment');
    }


}
