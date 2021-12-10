<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\PlantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *  normalizationContext={
 *      "groups"={"plants_read", "users_read"}
 *  },
 *  denormalizationContext={
 *      "groups"={"gardenerPlants_write"}
 *  }
 * )
 * @ORM\Entity(repositoryClass=PlantRepository::class)
 */
class Plant
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @groups({"plants_read", "users_read", "gardernerPlants_write"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     * @groups({"plants_read", "users_read"})
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     *  @groups({"plants_read", "users_read"})
     */
    private $image;

    /**
     * @ORM\Column(type="text")
     *  @groups({"plants_read", "users_read"})
     */
    private $description;

    /**
     * @ORM\Column(type="text")
     *  @groups({"plants_read", "users_read"})
     */
    private $exposition;

    /**
     * @ORM\Column(type="text")
     *  @groups({"plants_read", "users_read"})
     */
    private $care;

    /**
     * @ORM\Column(type="text")
     *  @groups({"plants_read", "users_read"})
     */
    private $toxicity;

    /**
     * @ORM\Column(type="integer")
     *  @groups({"plants_read", "users_read"})
     */
    private $frequency;

    /**
     * @ORM\Column(type="string", length=50)
     *  @groups({"plants_read", "users_read"})
     */
    private $type;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $updated_at;

    /**
     * @ORM\OneToMany(targetEntity=GardenerPlant::class, mappedBy="plant")
     */
    private $gardenerPlants;

    public function __construct()
    {
        $this->gardenerPlants = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getExposition(): ?string
    {
        return $this->exposition;
    }

    public function setExposition(string $exposition): self
    {
        $this->exposition = $exposition;

        return $this;
    }

    public function getCare(): ?string
    {
        return $this->care;
    }

    public function setCare(string $care): self
    {
        $this->care = $care;

        return $this;
    }

    public function getToxicity(): ?string
    {
        return $this->toxicity;
    }

    public function setToxicity(string $toxicity): self
    {
        $this->toxicity = $toxicity;

        return $this;
    }

    public function getFrequency(): ?int
    {
        return $this->frequency;
    }

    public function setFrequency(int $frequency): self
    {
        $this->frequency = $frequency;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

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
            $gardenerPlant->setPlant($this);
        }

        return $this;
    }

    public function removeGardenerPlant(GardenerPlant $gardenerPlant): self
    {
        if ($this->gardenerPlants->removeElement($gardenerPlant)) {
            // set the owning side to null (unless already changed)
            if ($gardenerPlant->getPlant() === $this) {
                $gardenerPlant->setPlant(null);
            }
        }

        return $this;
    }
}
