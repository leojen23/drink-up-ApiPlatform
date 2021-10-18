<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\GardenerPlantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=GardenerPlantRepository::class)
 */
class GardenerPlant
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $nickname;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $sunlight;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $size;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $season;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $topography;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $location;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $updated_at;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="gardenerPlants")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=Plant::class, inversedBy="gardenerPlants")
     * @ORM\JoinColumn(nullable=false)
     */
    private $plant;

    /**
     * @ORM\OneToMany(targetEntity=Watering::class, mappedBy="gardenerplant")
     */
    private $waterings;

    public function __construct()
    {
        $this->waterings = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNickname(): ?string
    {
        return $this->nickname;
    }

    public function setNickname(string $nickname): self
    {
        $this->nickname = $nickname;

        return $this;
    }

    public function getSunlight(): ?string
    {
        return $this->sunlight;
    }

    public function setSunlight(string $sunlight): self
    {
        $this->sunlight = $sunlight;

        return $this;
    }

    public function getSize(): ?string
    {
        return $this->size;
    }

    public function setSize(string $size): self
    {
        $this->size = $size;

        return $this;
    }

    public function getSeason(): ?string
    {
        return $this->season;
    }

    public function setSeason(string $season): self
    {
        $this->season = $season;

        return $this;
    }

    public function getTopography(): ?string
    {
        return $this->topography;
    }

    public function setTopography(string $topography): self
    {
        $this->topography = $topography;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(string $location): self
    {
        $this->location = $location;

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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getPlant(): ?Plant
    {
        return $this->plant;
    }

    public function setPlant(?Plant $plant): self
    {
        $this->plant = $plant;

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
            $watering->setGardenerplant($this);
        }

        return $this;
    }

    public function removeWatering(Watering $watering): self
    {
        if ($this->waterings->removeElement($watering)) {
            // set the owning side to null (unless already changed)
            if ($watering->getGardenerplant() === $this) {
                $watering->setGardenerplant(null);
            }
        }

        return $this;
    }
}
