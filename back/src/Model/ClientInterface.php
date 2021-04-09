<?php
namespace App\Model;

use App\Operation;

interface ClientInterface
{
    public function getHistory():HistoryCollectionInterface;

    /**
     * return fee
     * @param Operation $income
     * @return float
     */
    public function addHistoryItem(Operation $income, bool $round=true):float;

    public function isBusiness():bool;

    public function isPrivete():bool;
}