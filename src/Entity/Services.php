<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ServicesRepository;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ServicesRepository::class)]
#[Vich\Uploadable]
class Services
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Vich\UploadableField(mapping: 'products', fileNameProperty: 'imageName', size: 'imageSize')]
    private ?File $imageFile = null;

    #[ORM\Column(nullable: true)]
    private ?string $imageName = null;

    #[ORM\Column(nullable: true)]
    private ?int $imageSize = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updated_at = null;

    #[ORM\Column(length: 255)]
    #[Assert\Length(
        min: 3,
        minMessage: 'Le titre doit contenir au moins {{ limit }} caractères',
        max: 50, 
        maxMessage: 'Le titre ne peut pas dépasser {{ limit }} caractères')]
    private ?string $serviceTitle = null;

    #[ORM\Column(length: 255)]
    #[Assert\Length(
        min: 3,
        minMessage: 'La description doit contenir au moins {{ limit }} caractères',
        max: 255, 
        maxMessage: 'La description ne peut pas dépasser {{ limit }} caractères')]
    private ?string $description = null;

    #[ORM\Column]
    private ?float $price = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getServiceTitle(): ?string
    {
        return $this->serviceTitle;
    }

    public function setServiceTitle(string $serviceTitle): static
    {
        $this->serviceTitle = $serviceTitle;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

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

    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile|null $imageFile
     */
    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;
        if (null !== $imageFile) {
            $this->updated_at = new \DateTimeImmutable();
        }

    }
    public function getImageFile(): ?File
    {
        return $this->imageFile;
        
        
    }

    public function setImageName(?string $imageName): void
    {
        $this->imageName = $imageName;
        
        dump($imageName);
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    public function setImageSize(?int $imageSize): void
    {
        $this->imageSize = $imageSize;
    }

    public function getImageSize(): ?int
    {
        return $this->imageSize;
    }


    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updated_at): static
    {
        $this->updated_at = $updated_at;

        return $this;
    }
}
