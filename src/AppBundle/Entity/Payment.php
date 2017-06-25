<?php

namespace AppBundle\Entity;

/**
 * Payment
 */
class Payment
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var float
     */
    private $amount;



    /**
     * @var \AppBundle\Entity\Transactions
     */
    private $transactions;

    /**
     * @var \AppBundle\Entity\User
     */
    private $user;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set amount
     *
     * @param float $amount
     *
     * @return Payment
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount
     *
     * @return float
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set transactions
     *
     * @param \AppBundle\Entity\Transactions $transactions
     *
     * @return Payment
     */
    public function setTransactions(\AppBundle\Entity\Transactions $transactions = null)
    {
        $this->transactions = $transactions;

        return $this;
    }

    /**
     * Get transactions
     *
     * @return \AppBundle\Entity\Transactions
     */
    public function getTransactions()
    {
        return $this->transactions;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Payment
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}
