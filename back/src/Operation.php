<?php


namespace App;

use \Datetime;
class Operation
{
    private const PRIVATE = 'private';

    private const BUSINESS = 'business';

    private const WITHDRAW = 'withdraw';

    private const DEPOSIT = 'deposit';

    private Datetime $date;

    private int $userId;

    /**
     * @var string private|business
     */
    private string $userType;

    /**
     * operation type, one of deposit or withdraw
     * @var string
     */
    private string $operationType;

    /**
     * operation amount (for example 2.12 or 3)
     * @var float
     *
     */
    private float $amount;

    private float $amountEur;

    /**
     * operation currency, one of EUR, USD, JPY
     * @var string
     *
     */
    private string $currency;

    /**
     * @return Datetime
     */
    public function getDate(): Datetime
    {
        return $this->date;
    }

    /**
     * @param Datetime $date
     * @return Operation
     */
    public function setDate(Datetime $date): Operation
    {
        $this->date = $date;
        return $this;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @param int $userId
     * @return Operation
     */
    public function setUserId(int $userId): Operation
    {
        $this->userId = $userId;
        return $this;
    }

    /**
     * @return string
     */
    public function getUserType(): string
    {
        return $this->userType;
    }

    /**
     * @param string $userType
     * @return Operation
     */
    public function setUserType(string $userType): Operation
    {
        $this->userType = $userType;
        return $this;
    }

    /**
     * @return string
     */
    public function getOperationType(): string
    {
        return $this->operationType;
    }

    /**
     * @param string $operationType
     * @return Operation
     */
    public function setOperationType(string $operationType): Operation
    {
        $this->operationType = $operationType;
        return $this;
    }

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * @param float $amount
     * @return Operation
     */
    public function setAmount(float $amount): Operation
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }

    /**
     * @param string $currency
     * @return Operation
     */
    public function setCurrency(string $currency): Operation
    {
        $this->currency = $currency;
        return $this;
    }

    public function isPrivate():bool{
        return $this->userType == static::PRIVATE;
    }

    public function isBusiness():bool{
        return $this->userType == static::BUSINESS;
    }


    public function isDeposit():bool{
        return $this->operationType == static::DEPOSIT;
    }

    public function isWithdraw():bool{
        return $this->operationType == static::WITHDRAW;
    }

    public function isPrivateWithdraw():bool{
        return $this->isPrivate() && $this->isWithdraw();
    }

    public function isBusinessWithdraw():bool{
        return $this->isBusiness() && $this->isWithdraw();
    }

    public function getWeekNumber():int{
        return $this->getDate()->format('W');
    }

    public function getDayNumber():int{
        return $this->getDate()->format('w');
    }

    public function isTheSameWeek(Operation $op){
        return ($this->getDate()->format('W') == $op->getWeekNumber()) && abs($this->getDate()->getTimestamp() - $op->getDate()->getTimestamp()) < 432000    ;
    }

    /**
     * @return float
     */
    public function getAmountEur(): float
    {
        return $this->amountEur;
    }

    /**
     * @param float $amountEur
     */
    public function setAmountEur(float $amountEur): void
    {
        $this->amountEur = $amountEur;
    }


}