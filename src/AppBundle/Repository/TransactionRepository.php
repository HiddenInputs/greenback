<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Transaction;
use Doctrine\ORM\EntityRepository;

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
        return $this->createQueryBuilder('transaction')
            ->join('transaction.category', 'category')
            ->join('transaction.payment', 'payment')
            ->select(
                'transaction.id, category.name as categoryName, transaction.amount, 
                transaction.comment, payment.name as paymentMethod')
//            ->orderBy('category.name')
            ->getQuery()
            ->execute();
    }
}
