<?php

namespace App\Entity;

use App\Repository\PlaceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlaceRepository::class)]
class Place
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 32)]
    private ?string $type = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $imageUrl = null;

    #[ORM\Column(options: ['default' => 0])]
    private ?int $usersAssessment = 0;

    #[ORM\Column(type: Types::BIGINT, options: ['default' => 0])]
    private ?int $viewsCount = 0;

    /**
     * @var Collection<int, Flight>
     */
    #[ORM\OneToMany(targetEntity: Flight::class, mappedBy: 'fromPlace', orphanRemoval: true)]
    private Collection $fromFlights;

    /**
     * @var Collection<int, Flight>
     */
    #[ORM\OneToMany(targetEntity: Flight::class, mappedBy: 'toPlace', orphanRemoval: true)]
    private Collection $toFlights;

    /**
     * @var Collection<int, PlaceSeenItem>
     */
    #[ORM\OneToMany(targetEntity: PlaceSeenItem::class, mappedBy: 'place')]
    private Collection $seenItems;

    /**
     * @var Collection<int, PlaceUserFavorite>
     */
    #[ORM\OneToMany(targetEntity: PlaceUserFavorite::class, mappedBy: 'place')]
    private Collection $userFavorites;

    public function __construct()
    {
        $this->fromFlights = new ArrayCollection();
        $this->toFlights = new ArrayCollection();
        $this->seenItems = new ArrayCollection();
        $this->userFavorites = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getImageUrl(): ?string
    {
        return $this->imageUrl;
    }

    public function setImageUrl(?string $imageUrl): static
    {
        $this->imageUrl = $imageUrl;

        return $this;
    }

    public function getUsersAssessment(): ?int
    {
        return $this->usersAssessment;
    }

    public function setUsersAssessment(int $usersAssessment): static
    {
        $this->usersAssessment = $usersAssessment;

        return $this;
    }

    public function getViewsCount(): ?int
    {
        return $this->viewsCount;
    }

    public function setViewsCount(int $viewsCount): static
    {
        $this->viewsCount = $viewsCount;

        return $this;
    }

    /**
     * @return Collection<int, Flight>
     */
    public function getFromFlights(): Collection
    {
        return $this->fromFlights;
    }

    public function addFromFlight(Flight $fromFlight): static
    {
        if (!$this->fromFlights->contains($fromFlight)) {
            $this->fromFlights->add($fromFlight);
            $fromFlight->setFromPlace($this);
        }

        return $this;
    }

    public function removeFromFlight(Flight $fromFlight): static
    {
        if ($this->fromFlights->removeElement($fromFlight)) {
            // set the owning side to null (unless already changed)
            if ($fromFlight->getFromPlace() === $this) {
                $fromFlight->setFromPlace(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Flight>
     */
    public function getToFlights(): Collection
    {
        return $this->toFlights;
    }

    public function addToFlight(Flight $toFlight): static
    {
        if (!$this->toFlights->contains($toFlight)) {
            $this->toFlights->add($toFlight);
            $toFlight->setToPlace($this);
        }

        return $this;
    }

    public function removeToFlight(Flight $toFlight): static
    {
        if ($this->toFlights->removeElement($toFlight)) {
            // set the owning side to null (unless already changed)
            if ($toFlight->getToPlace() === $this) {
                $toFlight->setToPlace(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, PlaceSeenItem>
     */
    public function getSeenItems(): Collection
    {
        return $this->seenItems;
    }

    public function addSeenItem(PlaceSeenItem $seenItem): static
    {
        if (!$this->seenItems->contains($seenItem)) {
            $this->seenItems->add($seenItem);
            $seenItem->setPlace($this);
        }

        return $this;
    }

    public function removeSeenItem(PlaceSeenItem $seenItem): static
    {
        if ($this->seenItems->removeElement($seenItem)) {
            // set the owning side to null (unless already changed)
            if ($seenItem->getPlace() === $this) {
                $seenItem->setPlace(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, PlaceUserFavorite>
     */
    public function getUserFavorites(): Collection
    {
        return $this->userFavorites;
    }

    public function addUserFavorite(PlaceUserFavorite $userFavorite): static
    {
        if (!$this->userFavorites->contains($userFavorite)) {
            $this->userFavorites->add($userFavorite);
            $userFavorite->setPlace($this);
        }

        return $this;
    }

    public function removeUserFavorite(PlaceUserFavorite $userFavorite): static
    {
        if ($this->userFavorites->removeElement($userFavorite)) {
            // set the owning side to null (unless already changed)
            if ($userFavorite->getPlace() === $this) {
                $userFavorite->setPlace(null);
            }
        }

        return $this;
    }
}
