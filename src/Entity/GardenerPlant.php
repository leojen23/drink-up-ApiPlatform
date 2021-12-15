<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\handlers\WateringActionProcessor;
use App\Repository\GardenerPlantRepository;
use DateInterval;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;
use WateringHandler;

/**
 * @ApiResource(
 *  normalizationContext={
 *      "groups"={"gardenerPlants_read", "users_read"}
 *  },
 * denormalizationContext={
 *      "groups"={"gardenerPlants_write"}
 * }
 * 
 * )
 * @ORM\Entity(repositoryClass=GardenerPlantRepository::class)
 */
class GardenerPlant
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @groups({"gardenerPlants_read", "users_read", "gardenerPlants_write"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     * @groups({"gardenerPlants_read", "users_read", "gardenerPlants_write"})
     */
    private $nickname;

    /**
     * @ORM\Column(type="string", length=100)
     * @groups({"gardenerPlants_read", "users_read", "gardenerPlants_write"})
     */
    private $sunlight;

    /**
     * @ORM\Column(type="string", length=100)
     * @groups({"gardenerPlants_read", "users_read", "gardenerPlants_write"})
     */
    private $size;

    /**
     * @ORM\Column(type="string", length=100)
     * @groups({"gardenerPlants_read", "users_read", "gardenerPlants_write"})
     */
    private $season;

    /**
     * @ORM\Column(type="string", length=100)
     * @groups({"gardenerPlants_read", "users_read", "gardenerPlants_write"})
     */
    private $topography;

    /**
     * @ORM\Column(type="string", length=100)
     * @groups({"gardenerPlants_read", "users_read", "gardenerPlants_write"})
     */
    private $location;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     * @ORM\GeneratedValue
     * 
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     * @ORM\GeneratedValue
     * 
     */
    private $updatedAt;


    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="gardenerPlants")
     * @ORM\JoinColumn(nullable=true)
     * @groups({"gardenerPlants_write"})
   
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=Plant::class, inversedBy="gardenerPlants")
     * @ORM\JoinColumn(nullable=true)
     * @groups({"gardenerPlants_read", "users_read", "gardenerPlants_write"})
     */
    private $plant;

    /**
     * @ORM\OneToMany(targetEntity=Watering::class, mappedBy="gardenerplant")
     * @groups({"gardenerPlants_read", "users_read"})
     */
    private $waterings;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     *  * @groups({"gardenerPlants_read", "users_read", "gardenerPlants_write"})
     */
    private $lastWateringDate;

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
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeImmutable $createdAt): self
    {
        $this->created_at = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updatedAt): self
    {
        $this->updated_at = $updatedAt;

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
     /**
     * @groups({"users_read", "gardenerPlants_read"})
     * @return int
     */
    public function getWateringFrequency(): int {
        $gardenerPlant = $this;
        $wateringHandler = new WateringHandler(new WateringActionProcessor());
        $wateringFrequency = $wateringHandler->process($gardenerPlant);
        if ($wateringFrequency <= 1){
            return 2;
        } 
        return $wateringFrequency;
    }
 /**
     * @groups({"users_read", "gardenerPlants_read"})
     * @return string
     */
    public function getNextWateringDate(): string {
        $wateringFrequency = $this->getWateringFrequency();
        $lastWateringDate = $this->getLastWateringDate();
        $nextWateringDate = $lastWateringDate->modify('+'.$wateringFrequency.'day'); 
        return $nextWateringDate->format('d-m-Y');
    }
 /**
     * Récupération du status de l'arrosage
     * @groups({"users_read", "gardenerPlants_read"})
     * @return int
     */
    public function getWateringStatus(){
        $wateringFrequency = $this->getWateringFrequency();
        $lastWateringDate = $this->getLastWateringDate();
        $lastWateringDate->modify('-'.$wateringFrequency.'day'); 
        $lastWateringDate = $this->getLastWateringDate();
        $nextWateringDate = $lastWateringDate->modify('+'.$wateringFrequency.'day');
        $today = new DateTime();
        $interval = $today->diff($nextWateringDate);
        $interval = $nextWateringDate->diff($today);
        $intervalFormatted = $interval->format("%r%a");
        
        if ($intervalFormatted < 0){
            return 1;
        } elseif ($intervalFormatted == 0){
            return 2;
        }elseif ($intervalFormatted > 0){
            return 3;
        }else{
            return 0;
        }
        
    }
    /**
     * Récupération du nombre de jour de retard
     * @groups({"users_read", "gardenerPlants_read"})
     * @return string
     */
    public function getNumberOfLateDays(): string{
        $wateringFrequency = $this->getWateringFrequency();
        $lastWateringDate = $this->getLastWateringDate();
        $lastWateringDate->modify('-'.$wateringFrequency.'day'); 
        $lastWateringDate = $this->getLastWateringDate();
        $nextWateringDate = $lastWateringDate->modify('+'.$wateringFrequency.'day');
        $today = new DateTime();
        $interval = $nextWateringDate->diff($today);
        return $interval->format("%r%a");
    }
    /**
     * Récupération du status de l'arrosage
     * @groups({"users_read", "gardenerPlants_read"})
     *
     */
    public function getLastWateringDate(): ?\DateTimeInterface
    {
        
        return $this->lastWateringDate;
    }

    public function setLastWateringDate(?\DateTimeInterface $lastWateringDate): self

    {
        // $lastWateringDate = \DateTime::createFromFormat('Y-m-d H:i:s', strtotime('now'));
        $this->lastWateringDate = $lastWateringDate;

        return $this;
    }
}
