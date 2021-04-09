<?php

namespace App\Command;

use App\Operation;
use App\Model\ClientRepository;
use App\Services\ParseHelper;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Serializer\SerializerInterface;


use \BenMajor\ExchangeRatesAPI\ExchangeRatesAPI;
use \BenMajor\ExchangeRatesAPI\Response;
use \BenMajor\ExchangeRatesAPI\Exception;

class ParseCommand extends Command
{
    protected static $defaultName = 'app:parse';
    protected static $defaultDescription = 'Calculates fee from csv file';
    private SerializerInterface $serializer;
    private ParseHelper $parser;

    protected function configure()
    {
        $this
            ->setDescription(self::$defaultDescription)
            ->addArgument('filename', InputArgument::OPTIONAL, 'csv file')
        ;
    }

    public function __construct(SerializerInterface  $serializer, ParseHelper $parser)
    {
        $this->serializer = $serializer;
        $this->parser = $parser;
        parent::__construct('app:parse');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {

        $file = $input->getArgument('filename');

        if ($file) {
            $rows = $this->parser->parse($file);
            if(count($rows)){
                foreach ($rows as $k => $row){
                    $client = ClientRepository::getOrCreateClient($row);
                    $fee = $client->addHistoryItem($row);
                    $fee = ceil($fee * 100) / 100;
                    $output->writeln(number_format($fee,2));
                }
            }
        }
        return Command::SUCCESS;
    }
}
