<?php


namespace App\Tests;

use App\Operation;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
class DenormalizationTest extends KernelTestCase
{
    private SerializerInterface  $serializer;

    protected function setUp():void
    {
        self::bootKernel();
        $this->serializer = self::$container->get(SerializerInterface::class);
    }

    public function testOne()
    {
        $data = array (
            0 => '2014-12-31',
            1 => '4',
            2 => 'private',
            3 => 'withdraw',
            4 => '1200.00',
            5 => 'EUR',
        );
        /**
         * @var $o Operation
         */
        $o = $this->serializer->denormalize($data, Operation::class);
        $this->assertInstanceOf(Operation::class, $o);
        $this->assertTrue($o->isWithdraw());
        $this->assertTrue($o->isPrivateWithdraw());
        $this->assertFalse($o->isDeposit());
    }


}