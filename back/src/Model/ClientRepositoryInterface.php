<?php
namespace App\Model;

use App\Operation;

interface ClientRepositoryInterface
{
    public static function getOrCreateClient(Operation $income):ClientInterface;
}