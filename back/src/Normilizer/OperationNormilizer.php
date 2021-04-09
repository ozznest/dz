<?php
namespace App\Normilizer;

use App\Operation;
use Symfony\Component\Serializer\Exception\BadMethodCallException;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\Exception\ExtraAttributesException;
use Symfony\Component\Serializer\Exception\InvalidArgumentException;
use Symfony\Component\Serializer\Exception\LogicException;
use Symfony\Component\Serializer\Exception\RuntimeException;
use Symfony\Component\Serializer\Exception\UnexpectedValueException;
use Symfony\Component\Serializer\Normalizer\ContextAwareDenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ContextAwareNormalizerInterface;
use App\Services\Exchange;

class OperationNormilizer implements ContextAwareDenormalizerInterface
{
    private Exchange $exchange;
    public function __construct(Exchange $exchange)
    {
        $this->exchange = $exchange;
    }


    public function supportsDenormalization($data, $type, $format = null, array $context = [])
    {
        return $type === Operation::class;
    }

    public function denormalize($data, $type, $format = null, array $context = [])
    {
        $inc = new Operation();

        $inc->setDate(\DateTime::createFromFormat('Y-m-d', $data[0]))
            ->setUserId($data[1])
            ->setUserType($data[2])
            ->setOperationType($data[3])
            ->setAmount($data[4])
            ->setCurrency($data[5]);

        if($inc->isPrivateWithdraw()){

            $cource = $this->exchange->getByDate($inc->getDate(), $inc->getCurrency());

            $inc->setAmountEur($inc->getAmount() / $cource);
        }

        return $inc;
    }


}