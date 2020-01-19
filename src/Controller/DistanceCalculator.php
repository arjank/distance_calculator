<?php
declare(strict_types=1);

namespace App\Controller;

use App\Model\Calculator;
use App\Model\Distance;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class DistanceCalculator
{
    private Calculator $calculator;
    private SerializerInterface $serializer;


    public function __construct(SerializerInterface $serializer, Calculator $calculator)
    {
        $this->serializer = $serializer;
        $this->calculator = $calculator;
    }

    /**
     * @Route("/")
     */
    public function calculate()
    {
        [$unit, $distances] = $this->parseJsonInput();

        $distance = $this->calculator->add($unit, ...$distances);

        $jsonContent = $this->serializer->serialize($distance, 'json');
        return (new JsonResponse())->setJson($jsonContent);
    }

    private function parseJsonInput()
    {
        $jsonInput = file_get_contents('php://input');

        $decoded = json_decode($jsonInput, true);

        $outputFormat = $decoded['output'];

        $distances = array_map(fn($a) => $this->serializer->deserialize(json_encode($a), Distance::class, 'json'), $decoded['distances']);

        return [$outputFormat, $distances];
    }
}
