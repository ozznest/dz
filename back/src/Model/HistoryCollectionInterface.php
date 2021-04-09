<?php


namespace App\Model;


use App\Operation;

interface HistoryCollectionInterface
{
    public function addItem(Operation $income);
    public function getWthOperationsDuringWeek(Operation $operation):int;
    public function getWthSummDuringWeek(Operation $operation):float;

}