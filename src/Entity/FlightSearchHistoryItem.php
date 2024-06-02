<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Put;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\SearchHistoryItemRepository;

#[ORM\Entity(repositoryClass: SearchHistoryItemRepository::class)]
class FlightSearchHistoryItem extends SearchHistoryItem
{
    #[ORM\ManyToOne(inversedBy: 'historyItems')]
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
