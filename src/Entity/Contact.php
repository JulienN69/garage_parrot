<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use App\Repository\ContactRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ContactRepository::class)]
class Contact
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:'veuillez saisir votre nom')]
    private ?string $last_name = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:'veuillez saisir votre prénom')]
    private ?string $first_name = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    #[Assert\Email(message:'email non valide')]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:'veuillez saisir un numéro de téléphone')]
    #[Assert\Regex('^0[1-9]([ .-]?[0-9]{2}){4}$^')]
    private ?string $phone = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:'veuillez saisir un sujet')]
    private ?string $message_title = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank(message:'veuillez saisir un message')]
    private ?string $message_content = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    public function setLastName(string $last_name): static
    {
        $this->last_name = $last_name;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    public function setFirstName(string $first_name): static
    {
        $this->first_name = $first_name;

        return $this;
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

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): static
    {
        $this->phone = $phone;

        return $this;
    }

    public function getMessageTitle(): ?string
    {
        return $this->message_title;
    }

    public function setMessageTitle(string $message_title): static
    {
        $this->message_title = $message_title;

        return $this;
    }

    public function getMessageContent(): ?string
    {
        return $this->message_content;
    }

    public function setMessageContent(string $message_content): static
    {
        $this->message_content = $message_content;

        return $this;
    }
}
