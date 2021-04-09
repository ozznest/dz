<?php


namespace App\Services;


use App\Operation;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Serializer\SerializerInterface;

class ParseHelper
{
    private SerializerInterface $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    public function parse(?string $fileneme):?array
    {
        if($fileneme){
            $finder = new Finder();
            $finder->files()
                ->in('.')
                ->name($fileneme)
            ;
            foreach ($finder as $file) {
                $csv = $file;
            }

            $rows = [];
            if (($handle = fopen($csv->getRealPath(), "r")) !== FALSE) {
                $i = 0;
                while (($data = fgetcsv($handle, null, ",")) !== FALSE) {
                    $i++;
                    $rows[] = $this->serializer->denormalize($data, Operation::class);
                }
                fclose($handle);
            }
            return $rows;
        }
    }

}