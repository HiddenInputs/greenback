<?php

namespace AppBundle\Entity;

/**
 * Transactions
 */
class Transactions
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $quantity;

    /**
     * @var Payment
     */
    private $payment;


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
     * Set quantity
     *
     * @param integer $quantity
     *
     * @return Transactions
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return integer
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set payment
     *
     * @param Payment $payment
     *
     * @return Transactions
     */
    public function setPayment(Payment $payment = null)
    {
        $this->payment = $payment;

        return $this;
    }

    /**
     * Get payment
     *
     * @return Payment
     */
    public function getPayment()
    {
        return $this->payment;
    }
}
