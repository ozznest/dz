<?php


namespace App\Model;


use App\Operation;

class ClientRepository implements ClientRepositoryInterface
{
    private static $clients;


    public static function getOrCreateClient(Operation $income): ClientInterface
    {
       $id = $income->getUserId();
       if(!isset(static::$clients[$id])){
           static::$clients[$id] = new Client($id);
       }
       return static::$clients[$id];
    }
}