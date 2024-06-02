<?php

namespace App\State;

use ApiPlatform\Metadata\CollectionOperationInterface;
use ApiPlatform\State\ProcessorInterface;
use App\Entity\Api\Request\RegisterRequest;
use App\Entity\User;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\Metadata\Post;
use ApiPlatform\State\ProviderInterface;
use App\Entity\Api\Request\RegisterResponse;
use App\Entity\Flight;
use App\Service\ApiClient\PriceCounterClient;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;

final class FlightSearchProvider implements ProviderInterface
{

    public function __construct(
        #[Autowire(service: 'api_platform.doctrine.orm.state.collection_provider')]
        private ProviderInterface $itemProvider,
        private readonly UserPasswordHasherInterface $passwordHasher,
        private readonly JWTTokenManagerInterface $JWTManager,
        private readonly EntityManagerInterface $em,
        private readonly PriceCounterClient $priceCounterClient,
    ) {
    }

    // TODO кэширование
    /**
     * @param Flight[] $data
     *
     * @return Flight[]
     * 
     * @throws InvalidArgumentException
     */
    public function provide(Operation $operation, array $uriVariables = [], array $context = []): array
    {
        /** @var Flight[] */
        $flights = $this->itemProvider->provide($operation, $uriVariables, $context);

        // {
        // "0" : {
        //     "airline":"Air India",
        //     "from": "Delhi",
        //     "to": "Chennai",
        //     "dep_time": "18:00",
        //     "arr_time": "10:55",
        //     "time_taken": "16h 55m",
        //     "stop": "1-stop",
        //     "class":"0"
        //     },
        // "1" : {
        //     "airline":"Indigo",
        //     "from": "Delhi",
        //     "to": "Chennai",
        //     "dep_time": "18:00",
        //     "arr_time": "10:55",
        //     "time_taken": "16h 55m",
        //     "stop": "1-stop",
        //     "class":"1"
        //     }
        // }

        $requestBody = [];
        foreach ($flights as $flight) {
            $requestBody[] = [
                'airline' => $flight->getAirline()->getName(),
                'from' => $flight->getFromPlace()->getName(),
                'to' => $flight->getToPlace()->getName(),
                'dep_time' => $flight->getStartTime()->format('H:i'),
                'arr_time' => $flight->getEndTime()->format('H:i'),
                'time_taken' => $flight->getEndTime()->diff($flight->getStartTime())->format('%hh %Im'),
                'stop' => $flight->getStop(),
                'class' => $flight->getClass()
            ];
        }

        $predictions = $this->priceCounterClient->getPrices($requestBody);

        foreach ($flights as $i => $flight) {
            $flight->setPrice($predictions[$i]);

            $this->em->persist($flight);
        }

        $this->em->flush();

        return $flights;
    }
}
