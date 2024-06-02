<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Put;
use App\Entity\UserFavorite;
use App\Repository\UserFavoriteRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: UserFavoriteRepository::class)]
#[ApiResource(
    routePrefix: '/user/favorite-flights',
    operations: [
        new Put(
            uriTemplate: '/add',
            denormalizationContext: ['groups' => ['addFavorite']]
        ),
        new Delete(
            uriTemplate: '/remove'
        )
    ]
)]
class FlightUserFavorite extends UserFavorite
{
    #[ORM\ManyToOne(inversedBy: 'userFavorites')]
    private ?Flight $flight = null;

    public function getFlight(): ?Flight
    {
        return $this->flight;
    }

    public function setFlight(?Flight $flight): static
    {
        $this->flight = $flight;

        return $this;
    }

    public function getFlightId(): int
    {
        return $this->flight->getId();
    }
}
