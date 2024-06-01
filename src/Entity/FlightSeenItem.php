<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\SeenItemRepository;

#[ORM\Entity(repositoryClass: SeenItemRepository::class)]
class FlightSeenItem extends SeenItem
{
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
