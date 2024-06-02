<?php

namespace App\State;

use ApiPlatform\State\ProcessorInterface;
use App\Entity\Api\Request\RegisterRequest;
use App\Entity\User;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\Metadata\Post;
use App\Entity\Api\Request\RegisterResponse;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

final class UserRegisterProcessor implements ProcessorInterface
{

    public function __construct(
        private readonly UserPasswordHasherInterface $passwordHasher,
        private readonly JWTTokenManagerInterface $JWTManager,
        private readonly EntityManagerInterface $em
    ) {
    }

    /**
     * @param User $data
     *
     * @throws InvalidArgumentException
     */
    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): RegisterResponse
    {
        if (!$data->getPassword()) {
            throw new \InvalidArgumentException('Password not provided');
        }

        $data->setPassword($this->passwordHasher->hashPassword(
            $data,
            $data->getPassword()
        ));
        $data->eraseCredentials();

        $this->em->persist($data);
        $this->em->flush();

        // Если это операция по созданию нового пользователя, то генерим токен и назначаем роль по умолчанию 
        if ($operation instanceof Post) {
            $response = new RegisterResponse();
            $response->token = $this->JWTManager->create($data);
        }

        return $response;
    }
}
