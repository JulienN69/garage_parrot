<?php

namespace App\Entity;

use App\Repository\SchedulesRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: SchedulesRepository::class)]
class Schedules
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    #[Assert\Length(
        min: 3,
        minMessage: 'Le modèle doit contenir au moins {{ limit }} caractères',
        max: 50, 
        maxMessage: 'Le modèle ne peut pas dépasser {{ limit }} caractères')]
    private ?string $day = null;

    #[ORM\Column(length: 50, nullable: true)]
    #[Assert\Length(
        min: 3,
        minMessage: 'Le modèle doit contenir au moins {{ limit }} caractères',
        max: 50, 
        maxMessage: 'Le modèle ne peut pas dépasser {{ limit }} caractères')]
    private ?string $schedules_morning = null;

    #[ORM\Column(length: 50, nullable: true)]
    #[Assert\Length(
        min: 3,
        minMessage: 'Le modèle doit contenir au moins {{ limit }} caractères',
        max: 50, 
        maxMessage: 'Le modèle ne peut pas dépasser {{ limit }} caractères')]
    private ?string $schedules_afternoon = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDay(): ?string
    {
        return $this->day;
    }

    public function setDay(string $day): static
    {
        $this->day = $day;

        return $this;
    }

    public function getSchedulesMorning(): ?string
    {
        return $this->schedules_morning;
    }

    public function setSchedulesMorning(string $schedules_morning): static
    {
        $this->schedules_morning = $schedules_morning;

        return $this;
    }

    public function getSchedulesAfternoon(): ?string
    {
        return $this->schedules_afternoon;
    }

    public function setSchedulesAfternoon(string $schedules_afternoon): static
    {
        $this->schedules_afternoon = $schedules_afternoon;

        return $this;
    }
}
