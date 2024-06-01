<?php

namespace App\Entity;

use App\Repository\FlightRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FlightRepository::class)]
class Flight
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $price = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $startTime = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $endTime = null;

    #[ORM\Column(options: ['default' => 0])]
    private ?int $transfersCount = 0;

    #[ORM\Column(type: Types::BIGINT, options: ['default' => 0])]
    private ?int $viewsCount = 0;

    #[ORM\ManyToOne(inversedBy: 'flights')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Airline $airline = null;

    #[ORM\ManyToOne(inversedBy: 'fromFlights')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Place $fromPlace = null;

    #[ORM\ManyToOne(inversedBy: 'toFlights')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Place $toPlace = null;

    /**
     * @var Collection<int, FlightSeenItem>
     */
    #[ORM\OneToMany(targetEntity: FlightSeenItem::class, mappedBy: 'flight')]
    private Collection $seenItems;

    /**
     * @var Collection<int, FlightSearchHistoryItem>
     */
    #[ORM\OneToMany(targetEntity: FlightSearchHistoryItem::class, mappedBy: 'flight')]
    private Collection $historyItems;

    /**
     * @var Collection<int, FlightUserFavorite>
     */
    #[ORM\OneToMany(targetEntity: FlightUserFavorite::class, mappedBy: 'flight')]
    private Collection $userFavorites;

    public function __construct()
    {
        $this->seenItems = new ArrayCollection();
        $this->historyItems = new ArrayCollection();
        $this->userFavorites = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getStartTime(): ?\DateTimeInterface
    {
        return $this->startTime;
    }

    public function setStartTime(\DateTimeInterface $startTime): static
    {
        $this->startTime = $startTime;

        return $this;
    }

    public function getEndTime(): ?\DateTimeInterface
    {
        return $this->endTime;
    }

    public function setEndTime(\DateTimeInterface $endTime): static
    {
        $this->endTime = $endTime;

        return $this;
    }

    public function getTransfersCount(): ?int
    {
        return $this->transfersCount;
    }

    public function setTransfersCount(int $transfersCount): static
    {
        $this->transfersCount = $transfersCount;

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

    public function getAirline(): ?Airline
    {
        return $this->airline;
    }

    public function setAirline(?Airline $airline): static
    {
        $this->airline = $airline;

        return $this;
    }

    public function getFromPlace(): ?Place
    {
        return $this->fromPlace;
    }

    public function setFromPlace(?Place $fromPlace): static
    {
        $this->fromPlace = $fromPlace;

        return $this;
    }

    public function getToPlace(): ?Place
    {
        return $this->toPlace;
    }

    public function setToPlace(?Place $toPlace): static
    {
        $this->toPlace = $toPlace;

        return $this;
    }

    /**
     * @return Collection<int, FlightSeenItem>
     */
    public function getSeenItems(): Collection
    {
        return $this->seenItems;
    }

    public function addSeenItem(FlightSeenItem $seenItem): static
    {
        if (!$this->seenItems->contains($seenItem)) {
            $this->seenItems->add($seenItem);
            $seenItem->setFlight($this);
        }

        return $this;
    }

    public function removeSeenItem(FlightSeenItem $seenItem): static
    {
        if ($this->seenItems->removeElement($seenItem)) {
            // set the owning side to null (unless already changed)
            if ($seenItem->getFlight() === $this) {
                $seenItem->setFlight(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, FlightSearchHistoryItem>
     */
    public function getHistoryItems(): Collection
    {
        return $this->historyItems;
    }

    public function addHistoryItem(FlightSearchHistoryItem $historyItem): static
    {
        if (!$this->historyItems->contains($historyItem)) {
            $this->historyItems->add($historyItem);
            $historyItem->setFlight($this);
        }

        return $this;
    }

    public function removeHistoryItem(FlightSearchHistoryItem $historyItem): static
    {
        if ($this->historyItems->removeElement($historyItem)) {
            // set the owning side to null (unless already changed)
            if ($historyItem->getFlight() === $this) {
                $historyItem->setFlight(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, FlightUserFavorite>
     */
    public function getUserFavorites(): Collection
    {
        return $this->userFavorites;
    }

    public function addUserFavorite(FlightUserFavorite $userFavorite): static
    {
        if (!$this->userFavorites->contains($userFavorite)) {
            $this->userFavorites->add($userFavorite);
            $userFavorite->setFlight($this);
        }

        return $this;
    }

    public function removeUserFavorite(FlightUserFavorite $userFavorite): static
    {
        if ($this->userFavorites->removeElement($userFavorite)) {
            // set the owning side to null (unless already changed)
            if ($userFavorite->getFlight() === $this) {
                $userFavorite->setFlight(null);
            }
        }

        return $this;
    }
}
