<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $gender;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $surname;

    /**
     * @ORM\Column(type="boolean")
     */
    private $is_notified;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $updated_at;

    /**
     * @ORM\OneToMany(targetEntity=GardenerPlant::class, mappedBy="user")
     */
    private $gardenerPlants;

    /**
     * @ORM\OneToMany(targetEntity=Watering::class, mappedBy="user")
     */
    private $waterings;

    public function __construct()
    {
        $this->gardenerPlants = new ArrayCollection();
        $this->waterings = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
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
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
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

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(string $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): self
    {
        $this->surname = $surname;

        return $this;
    }

    public function getIsNotified(): ?bool
    {
        return $this->is_notified;
    }

    public function setIsNotified(bool $is_notified): self
    {
        $this->is_notified = $is_notified;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(?\DateTimeImmutable $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    /**
     * @return Collection|GardenerPlant[]
     */
    public function getGardenerPlants(): Collection
    {
        return $this->gardenerPlants;
    }

    public function addGardenerPlant(GardenerPlant $gardenerPlant): self
    {
        if (!$this->gardenerPlants->contains($gardenerPlant)) {
            $this->gardenerPlants[] = $gardenerPlant;
            $gardenerPlant->setUser($this);
        }

        return $this;
    }

    public function removeGardenerPlant(GardenerPlant $gardenerPlant): self
    {
        if ($this->gardenerPlants->removeElement($gardenerPlant)) {
            // set the owning side to null (unless already changed)
            if ($gardenerPlant->getUser() === $this) {
                $gardenerPlant->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Watering[]
     */
    public function getWaterings(): Collection
    {
        return $this->waterings;
    }

    public function addWatering(Watering $watering): self
    {
        if (!$this->waterings->contains($watering)) {
            $this->waterings[] = $watering;
            $watering->setUser($this);
        }

        return $this;
    }

    public function removeWatering(Watering $watering): self
    {
        if ($this->waterings->removeElement($watering)) {
            // set the owning side to null (unless already changed)
            if ($watering->getUser() === $this) {
                $watering->setUser(null);
            }
        }

        return $this;
    }
}
