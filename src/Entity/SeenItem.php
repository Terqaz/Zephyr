<?php

namespace App\Entity;

use App\Repository\SeenItemRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SeenItemRepository::class)]
#[ORM\InheritanceType('SINGLE_TABLE')]
#[ORM\DiscriminatorColumn(name: 'type', type: 'string')]
#[ORM\DiscriminatorMap([
    'flight' => FlightSeenItem::class,
    'place' => PlaceSeenItem::class,
])]
abstract class SeenItem
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    // #[ORM\Column(length: 32)]
    // private ?string $type = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $seenDate = null;

    #[ORM\ManyToOne(inversedBy: 'seenItems')]
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

    public function getSeenDate(): ?\DateTimeInterface
    {
        return $this->seenDate;
    }

    public function setSeenDate(\DateTimeInterface $seenDate): static
    {
        $this->seenDate = $seenDate;

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
