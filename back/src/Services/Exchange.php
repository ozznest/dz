<?php
namespace App\Services;

use GuzzleHttp\Client;

class Exchange
{
    private Client $client;

    private string $key;


    public function __construct(Client $client, string $key)
    {
        $this->client = $client;
        $this->key = $key;
    }

    public function getLatest(string $currency){
        $response = $this->client->get('latest', [ 'query' => ['access_key' => $this->key, 'base' =>'EUR', 'symbols' => $currency]]);
        $body = (string)$response->getBody();
        return \json_decode($body);
    }

    public function getByDate(\DateTime $date, $currency='USD'):float{
        if($currency == 'EUR') return 1;

        $params = [
            'access_key' => $this->key,
            'base' => 'EUR',
            'symbols' => $currency
        ];
        $dt = $date->format('Y-m-d');
        $response = $this->client->get('v1/' . $dt, [ 'query' => $params]);
        $res = \json_decode($response->getBody());
        return $res->rates->$currency;
    }
}