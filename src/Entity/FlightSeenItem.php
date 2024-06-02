<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Put;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\SeenItemRepository;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: SeenItemRepository::class)]
#[ApiResource(
    routePrefix: '/user/recent-flights',
    operations: [
        new Put(
            uriTemplate: '/add',
            normalizationContext: ['groups' => ['add']]
        )
    ]
)]
class FlightSeenItem extends SeenItem
{
    #[Groups(['add'])]
    #[ORM\ManyToOne(inversedBy: 'seenItems')]
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
}
