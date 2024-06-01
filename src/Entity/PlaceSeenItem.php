<?php

namespace App\Entity;

use App\Repository\SeenItemRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SeenItemRepository::class)]
class PlaceSeenItem extends SeenItem
{
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
