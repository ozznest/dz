<?php
namespace App\Model\OperationStrategy;

use App\Model\ClientInterface;
use App\Operation;

class OperationStrategyFactory
{
    public static function factory(Operation $operation,  ClientInterface $client):OperationStrategyInterface{
        if($operation->isDeposit()){
            return new DepositStrategy($operation->getAmount());
        } elseif ($operation->isBusinessWithdraw()){
            return new WithdrawBusinessStrategy($operation->getAmount());
        } else {
            return new WithdrawPrivateStrategy($operation, $client);
        }
    }

}