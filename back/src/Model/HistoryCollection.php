<?php


namespace App\Model;


use App\Operation;

class HistoryCollection implements HistoryCollectionInterface
{
    private array $historyItems = [];

    public function addItem(Operation $income){
        $this->historyItems[] = $income;
    }

    public function getWthOperationsDuringWeek(Operation $operation):int{
        $count = 0;

        if($operation->isPrivateWithdraw() && count($this->historyItems)){
            /* @var $it Operation*/
            foreach ($this->historyItems as $it){
                if($it->isPrivateWithdraw() && $operation->isTheSameWeek($it)){
                    $count++;
                }
            }

        }
        return $count;
    }

    public function getWthSummDuringWeek(Operation $operation):float{
        $sum = 0;
        /* @var $it Operation*/
        if(count($this->historyItems)  && $operation->isPrivateWithdraw()){
            foreach ($this->historyItems as $it){
                if($it->isPrivateWithdraw() && $operation->isTheSameWeek($it)){
                    $sum += $it->getAmountEur();
                }
            }
            return $sum;
        }
        return 0;
    }

    public function isLimitForWthOverflowedBySumm(Operation $operation): bool
    {
        return false;
    }

    public function isLimitForWthOverflowedByCount(): bool
    {
        return false;
    }
}