<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Transaction;
use Doctrine\ORM\EntityRepository;

class TransactionRepository extends EntityRepository
{
    /**
     * @return Transaction[]
     */
    public function findAllTransactionDetailsOrderedByName()
    {
        return $this->createQueryBuilder('transaction')
            ->join('transaction.category', 'category')
            ->select(
                'category.name, SUM(transaction.amount) as totalTransactions, 
                MAX(transaction.amount) as theLargestTransaction'
            )
            ->groupBy('category.name')
            ->getQuery()
            ->execute();
    }
}
