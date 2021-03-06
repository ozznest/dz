<?php


namespace App\Model;


use App\Model\OperationStrategy\OperationStrategyFactory;
use App\Operation;

class Client implements ClientInterface
{
    private $id;

    private ?HistoryCollectionInterface $historyCollection;

    public function __construct(int $id)
    {
        $this->id = $id;
        $this->historyCollection = new HistoryCollection();
    }

    public function addHistoryItem(Operation $income, bool $round=true):float
    {
        $fee =  OperationStrategyFactory::factory($income, $this)->getFee();
        $this->historyCollection->addItem($income);
        if($round){
            return  ceil($fee * 100) / 100;
        }
        return $fee;

    }


    public function getHistory(): HistoryCollectionInterface
    {
        return $this->historyCollection;
    }

    public function isBusiness(): bool
    {

    }

    public function isPrivete(): bool
    {

    }


}