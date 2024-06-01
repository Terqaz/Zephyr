<?php

namespace App\Entity;

use App\Repository\SearchHistoryItemRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SearchHistoryItemRepository::class)]
#[ORM\InheritanceType('SINGLE_TABLE')]
#[ORM\DiscriminatorColumn(name: 'type', type: 'string')]
#[ORM\DiscriminatorMap([
    'flight' => FlightSearchHistoryItem::class,
])]
abstract class SearchHistoryItem
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    // #[ORM\Column(length: 32)]
    // private ?string $type = null;

    #[ORM\Column(length: 1024)]
    private ?string $query = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $searchDate = null;

    #[ORM\ManyToOne(inversedBy: 'searchHistoryItems')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $userData = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    // public function getType(): ?string
    // {
    //     return $this->type;
    // }

    // public function setType(string $type): static
    // {
    //     $this->type = $type;

    //     return $this;
    // }

    public function getQuery(): ?string
    {
        return $this->query;
    }

    public function setQuery(string $query): static
    {
        $this->query = $query;

        return $this;
    }

    public function getSearchDate(): ?\DateTimeInterface
    {
        return $this->searchDate;
    }

    public function setSearchDate(\DateTimeInterface $searchDate): static
    {
        $this->searchDate = $searchDate;

        return $this;
    }

    public function getUserData(): ?User
    {
        return $this->userData;
    }

    public function setUserData(?User $userData): static
    {
        $this->userData = $userData;

        return $this;
    }
}
