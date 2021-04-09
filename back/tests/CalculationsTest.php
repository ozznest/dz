<?php


namespace App\Tests;


use App\Model\ClientRepository;
use App\Services\ParseHelper;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Serializer\SerializerInterface;

class CalculationsTest extends KernelTestCase
{
    private ParseHelper $parser;

    protected function setUp():void
    {
        self::bootKernel();
        $this->parser = self::$container->get(ParseHelper::class);
    }

    public function testCalculations(){
        $rows = $this->parser->parse('input.csv');
        $this->assertEquals(13, count($rows));


        $results = [
            0 => 0.6,
            1 => 3,
            2 => 0,
            3 => 0.06,
            4 => 1.5,
            5 => 0
        ];

        foreach ($rows as $k => $row){
            $client = ClientRepository::getOrCreateClient($row);
            $fee = $client->addHistoryItem($row);
            if(array_key_exists($k, $results)){
                $this->assertEquals($results[$k], $fee);
            }

        }
    }
}