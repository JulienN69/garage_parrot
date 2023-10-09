<?php

namespace App\Entity;

use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\CarPicturesRepository;
use Symfony\Component\HttpFoundation\File\File;

#[ORM\Entity(repositoryClass: CarPicturesRepository::class)]
#[Vich\Uploadable]
class CarPictures
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable:true)]
    private ?string $picture_name = null;

    #[ORM\Column]
    private ?int $picture_size = null;

    #[ORM\ManyToOne(inversedBy: 'carPictures')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Car $represented_by = null;

    // #[ORM\Column(length: 255)]
    // private ?string $picture_file = null;

    #[Vich\UploadableField(mapping: 'cars', fileNameProperty: 'picture_name', size: 'picture_size')]
    private ?File $picture_file = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updated_at = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPictureName(): ?string
    {
        return $this->picture_name;
    }

    public function setPictureName(string $picture_name = null): static
    {
        $this->picture_name = $picture_name;

        return $this;
    }

    public function getPictureSize(): ?int
    {
        return $this->picture_size;
    }

    public function setPictureSize(int $picture_size = null): static
    {
        $this->picture_size = $picture_size;

        return $this;
    }

    public function getRepresentedBy(): ?Car
    {
        return $this->represented_by;
    }

    public function setRepresentedBy(?Car $represented_by): static
    {
        $this->represented_by = $represented_by;

        return $this;
    }

    public function getPictureFile(): ?File
    {
        return $this->picture_file;
    }

    public function setPictureFile(?File $picture_file): static
    {
        $this->picture_file = $picture_file;

        if(null !== $picture_file) {
            $this->updated_at = new \DateTimeImmutable();
        }

        return $this;
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
