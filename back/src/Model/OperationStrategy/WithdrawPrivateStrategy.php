<?php


namespace App\Model\OperationStrategy;


use App\Model\ClientInterface;
use App\Operation;

class WithdrawPrivateStrategy implements OperationStrategyInterface
{
    private ClientInterface $client;

    private Operation $operation;
    public function __construct(Operation $operation, ClientInterface $client)
    {
        $this->operation = $operation;
        $this->client = $client;
    }

    public function getFee(): float
    {
        $countOverflow = $this->client->getHistory()->getWthOperationsDuringWeek($this->operation) > 3;
        if($countOverflow){
            return $this->operation->getAmount() * 0.003;
        }

        $wthSumm = $this->client->getHistory()->getWthSummDuringWeek($this->operation);
        if($wthSumm > 1000){
            return $this->operation->getAmount() * 0.003;
        }

        if($wthSumm < 1000 && $wthSumm + $this->operation->getAmountEur() > 1000){
            return ($wthSumm + $this->operation->getAmount() - 1000) * 0.003;
        }


        return 0;
    }
}