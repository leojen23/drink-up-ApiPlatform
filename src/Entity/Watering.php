<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\WateringRepository;
use Symfony\Component\Serializer\Annotation\Groups;

use Doctrine\ORM\Mapping as ORM;

/**
  * @ApiResource(
 *  attributes={
 *   "order": {"watered_at":"desc"}
 * },
 *  normalizationContext={
 *      "groups"={"waterings_read","users_read"}
 *  }
 * )
 * @ORM\Entity(repositoryClass=WateringRepository::class)

 */

 //test
class Watering
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @groups({"waterings_read","users_read"})
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * @groups({"waterings_read","users_read"})
     */
    private $lateness;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     * @groups({"waterings_read","users_read"})
     */
    private $watered_at;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     * 
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $updated_at;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="waterings")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=GardenerPlant::class, inversedBy="waterings")
     * @ORM\JoinColumn(nullable=false)
     * 
     */
    private $gardenerplant;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLateness(): ?int
    {
        return $this->lateness;
    }

    public function setLateness(int $lateness): self
    {
        $this->lateness = $lateness;

        return $this;
    }

    public function getWateredAt(): ?\DateTimeImmutable
    {
        return $this->watered_at;
    }

    public function setWateredAt(?\DateTimeImmutable $watered_at): self
    {
        $this->watered_at = $watered_at;

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

    public function getGardenerplant(): ?GardenerPlant
    {
        return $this->gardenerplant;
    }

    public function setGardenerplant(?GardenerPlant $gardenerplant): self
    {
        $this->gardenerplant = $gardenerplant;

        return $this;
    }
}
