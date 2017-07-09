<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Transaction;
use AppBundle\Entity\User;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;

class TransactionRepository extends EntityRepository
{
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

    /**
     * @param User $user
     * @return QueryBuilder
     */
    public function findFirstTransactionByLoggedUser(User $user)
    {
          return $this->createQueryBuilder('transaction')
                ->andWhere('transaction.id = :user')
                ->setParameter('user', $user)
                ->getQuery()
                ->getOneOrNullResult();
    }

//    /**
//     * @return QueryBuilder
//     */
//    public function findFirstTransactionByLoggedUser($user)
//    {
//        return $this->createQueryBuilder('transaction')
//            ->andWhere('transaction.id = :user')
//            ->setParameter('user', $user)
//            ->getQuery()
//            ->getOneOrNullResult();
//    }
}
