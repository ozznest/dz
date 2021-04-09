<?php


namespace App\Model\OperationStrategy;


class WithdrawBusinessStrategy implements OperationStrategyInterface
{

    private $parcent = 0.005;

    private $amount;

    public function __construct($amount)
    {

        $this->amount = $amount;
    }


    public function getFee(): float
    {
        return $this->amount * $this->parcent;
    }


}