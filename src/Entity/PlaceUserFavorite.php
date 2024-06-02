<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Put;
use App\Repository\UserFavoriteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserFavoriteRepository::class)]
#[ApiResource(
    routePrefix: '/user/favorite-places',
    operations: [
        new Put(
            uriTemplate: '/add'
        ),
        new Delete(
            uriTemplate: '/remove'
        )
    ]
)]
class PlaceUserFavorite extends UserFavorite
{
    #[ORM\ManyToOne(inversedBy: 'userFavorites')]
    private ?Place $place = null;

    public function getPlace(): ?Place
    {
        return $this->place;
    }

    public function setPlace(?Place $place): static
    {
        $this->place = $place;

        return $this;
    }
}
