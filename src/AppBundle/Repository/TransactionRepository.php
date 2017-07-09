<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Transaction;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;

class TransactionRepository extends EntityRepository
{
    /**
     * @return Transaction[]
     */
    public function findAllTransactionDetailsGroupedByName()
    {
        return $this->createQueryBuilder('transaction')
            ->join('transaction.category', 'category')
            ->select(
                'category.id, category.name, SUM(transaction.amount) as totalTransactions, 
                MAX(transaction.amount) as theLargestTransaction'
            )
            ->groupBy('category.name')
            ->getQuery()
            ->execute();
    }

    /**
     * @return Transaction[]
     */
    public function findAllTransactionsOrderedByCategoryName()
    {
        $qb = $this->createQueryBuilder('transaction')
            ->select(
                'transaction.id, category.name as categoryName, transaction.amount, 
                transaction.comment, payment.name as paymentMethod');
        $this->addCategoryAndPaymentJoin($qb);

        $query = $qb->getQuery();
        return  $query->execute();
    }

    /**
     * @param $from \DateTime
     * @param $to \DateTime
     * @return Transaction[]
     */
    public function findAllTransactionsBetweenSelectedDates($from, $to)
    {

        $qb = $this->createQueryBuilder('transaction')
            ->select(
                'transaction.id, category.name as categoryName, transaction.amount, 
                transaction.comment, payment.name as paymentMethod, transaction.createdAt')
            ->where('transaction.createdAt BETWEEN :from AND :to')
            ->setParameter('from', $from)
            ->setParameter('to', $to);

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
