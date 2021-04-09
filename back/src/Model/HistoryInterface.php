<?php
namespace App\Model;

use App\Operation;

interface HistoryInterface
{
    /**
     * @return \App\Operation
     */
    public function getIncomes():iterable;

    public function addIncome(Operation $inc):void;

    public function getFee(Operation $income):float;

    public function isWithdraw():bool;

    public function isDeposit():bool;

}