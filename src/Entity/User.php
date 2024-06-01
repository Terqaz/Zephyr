<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_EMAIL', fields: ['email'])]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180)]
    private ?string $email = null;

    #[ORM\Column(length: 128)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    /**
     * @var list<string> The user roles
     */
    #[ORM\Column]
    private array $roles = [];

    /** The hashed password */
    #[ORM\Column]
    private ?string $password = null;

    /**
     * @var Collection<int, SearchHistoryItem>
     */
    #[ORM\OneToMany(targetEntity: SearchHistoryItem::class, mappedBy: 'userData', orphanRemoval: true)]
    private Collection $searchHistoryItems;

    /**
     * @var Collection<int, UserFavorite>
     */
    #[ORM\OneToMany(targetEntity: UserFavorite::class, mappedBy: 'userData', orphanRemoval: true)]
    private Collection $favorites;

    /**
     * @var Collection<int, SeenItem>
     */
    #[ORM\OneToMany(targetEntity: SeenItem::class, mappedBy: 'userData', orphanRemoval: true)]
    private Collection $seenItems;

    public function __construct()
    {
        $this->searchHistoryItems = new ArrayCollection();
        $this->favorites = new ArrayCollection();
        $this->seenItems = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     *
     * @return list<string>
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @param list<string> $roles
     */
    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @return Collection<int, SearchHistoryItem>
     */
    public function getSearchHistoryItems(): Collection
    {
        return $this->searchHistoryItems;
    }

    public function addSearchHistoryItem(SearchHistoryItem $searchHistoryItem): static
    {
        if (!$this->searchHistoryItems->contains($searchHistoryItem)) {
            $this->searchHistoryItems->add($searchHistoryItem);
            $searchHistoryItem->setUserData($this);
        }

        return $this;
    }

    public function removeSearchHistoryItem(SearchHistoryItem $searchHistoryItem): static
    {
        if ($this->searchHistoryItems->removeElement($searchHistoryItem)) {
            // set the owning side to null (unless already changed)
            if ($searchHistoryItem->getUserData() === $this) {
                $searchHistoryItem->setUserData(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, UserFavorite>
     */
    public function getFavorites(): Collection
    {
        return $this->favorites;
    }

    public function addFavorite(UserFavorite $favorite): static
    {
        if (!$this->favorites->contains($favorite)) {
            $this->favorites->add($favorite);
            $favorite->setUserData($this);
        }

        return $this;
    }

    public function removeFavorite(UserFavorite $favorite): static
    {
        if ($this->favorites->removeElement($favorite)) {
            // set the owning side to null (unless already changed)
            if ($favorite->getUserData() === $this) {
                $favorite->setUserData(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, SeenItem>
     */
    public function getSeenItems(): Collection
    {
        return $this->seenItems;
    }

    public function addSeenItem(SeenItem $seenItem): static
    {
        if (!$this->seenItems->contains($seenItem)) {
            $this->seenItems->add($seenItem);
            $seenItem->setUserData($this);
        }

        return $this;
    }

    public function removeSeenItem(SeenItem $seenItem): static
    {
        if ($this->seenItems->removeElement($seenItem)) {
            // set the owning side to null (unless already changed)
            if ($seenItem->getUserData() === $this) {
                $seenItem->setUserData(null);
            }
        }

        return $this;
    }
}
