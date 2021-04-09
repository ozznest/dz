<?php


namespace App\Model\OperationStrategy;


class WithdrawStrategy implements OperationStrategyInterface
{


    public function getFee(): float
    {
        return 0.0;
    }

}