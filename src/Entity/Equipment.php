<?php

namespace App\Entity;

use App\Repository\EquipmentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: EquipmentRepository::class)]
class Equipment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\Length(
        min: 3,
        minMessage: 'Le modèle doit contenir au moins {{ limit }} caractères',
        max: 50, 
        maxMessage: 'Le modèle ne peut pas dépasser {{ limit }} caractères')]
    private ?string $equipmentTitle = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Assert\Length(
        min: 3,
        minMessage: 'La description doit contenir au moins {{ limit }} caractères',
        max: 500, 
        maxMessage: 'La description ne peut pas dépasser {{ limit }} caractères')]
    private ?string $description = null;

    #[ORM\ManyToMany(targetEntity: Car::class, mappedBy: 'is_equipped')]
    private Collection $cars;

    public function __construct()
    {
        $this->cars = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEquipmentTitle(): ?string
    {
        return $this->equipmentTitle;
    }

    public function setEquipmentTitle(string $equipmentTitle): static
    {
        $this->equipmentTitle = $equipmentTitle;

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

    public function __ToString()
    {
        return $this->getEquipmentTitle();
    }

    /**
     * @return Collection<int, Car>
     */
    public function getCars(): Collection
    {
        return $this->cars;
    }

    public function addCar(Car $car): static
    {
        if (!$this->cars->contains($car)) {
            $this->cars->add($car);
            $car->addIsEquipped($this);
        }

        return $this;
    }

    public function removeCar(Car $car): static
    {
        if ($this->cars->removeElement($car)) {
            $car->removeIsEquipped($this);
        }

        return $this;
    }

    // public function getCar(): ?Car
    // {
    //     return $this->car;
    // }

    // public function setCar(?Car $car): static
    // {
    //     $this->car = $car;

    //     return $this;
    // }

}
