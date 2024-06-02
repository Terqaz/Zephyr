<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Put;
use App\Repository\SeenItemRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: SeenItemRepository::class)]
#[ApiResource(
    routePrefix: '/user/recent-places',
    operations: [
        new Put(
            uriTemplate: '/add',
            normalizationContext: ['groups' => ['add']]
        ),
    ]
)]
class PlaceSeenItem extends SeenItem
{
    #[Groups(['add'])]
    #[ORM\ManyToOne(inversedBy: 'seenItems')]
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
