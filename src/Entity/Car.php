<?php

namespace App\Entity;

use App\Repository\CarRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CarRepository::class)]
class Car
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $mileage = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateCreation = null;

    #[ORM\Column]
    private ?float $price = null;

    #[ORM\Column(length: 50)]
    private ?string $modele = null;

    #[ORM\ManyToMany(targetEntity: Equipment::class, inversedBy: 'cars')]
    private Collection $is_equipped;

    #[ORM\OneToMany(mappedBy: 'car', targetEntity: Equipment::class)]
    private Collection $car_equipment;

    public function __construct()
    {
        $this->is_equipped = new ArrayCollection();
        $this->car_equipment = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMileage(): ?int
    {
        return $this->mileage;
    }

    public function setMileage(int $mileage): static
    {
        $this->mileage = $mileage;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->dateCreation;
    }

    public function setDateCreation(\DateTimeInterface $dateCreation): static
    {
        $this->dateCreation = $dateCreation;

        return $this;
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

    public function getModele(): ?string
    {
        return $this->modele;
    }

    public function setModele(string $modele): static
    {
        $this->modele = $modele;

        return $this;
    }

    /**
     * @return Collection<int, Equipment>
     */
    public function getIsEquipped(): Collection
    {
        return $this->is_equipped;
    }

    public function addIsEquipped(Equipment $isEquipped): static
    {
        if (!$this->is_equipped->contains($isEquipped)) {
            $this->is_equipped->add($isEquipped);
        }

        return $this;
    }

    public function removeIsEquipped(Equipment $isEquipped): static
    {
        $this->is_equipped->removeElement($isEquipped);

        return $this;
    }

    /**
     * @return Collection<int, Equipment>
     */
    public function getCarEquipment(): Collection
    {
        return $this->car_equipment;
    }

    public function addCarEquipment(Equipment $carEquipment): static
    {
        if (!$this->car_equipment->contains($carEquipment)) {
            $this->car_equipment->add($carEquipment);
            $carEquipment->setCar($this);
        }

        return $this;
    }

    public function removeCarEquipment(Equipment $carEquipment): static
    {
        if ($this->car_equipment->removeElement($carEquipment)) {
            // set the owning side to null (unless already changed)
            if ($carEquipment->getCar() === $this) {
                $carEquipment->setCar(null);
            }
        }

        return $this;
    }
}
