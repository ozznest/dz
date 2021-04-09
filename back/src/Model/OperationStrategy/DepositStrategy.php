<?php
namespace App\Model\OperationStrategy;

class DepositStrategy implements OperationStrategyInterface
{
    private $percant = 0.0003;

    public function __construct($amount)
    {
        $this->amount = $amount;
    }

    public function getFee(): float
    {
        return $this->amount * $this->percant;
    }

}