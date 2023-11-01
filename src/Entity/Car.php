<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\CarRepository;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\Common\Collections\ArrayCollection;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: CarRepository::class)]
#[Vich\Uploadable]
class Car
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    #[Assert\Positive(message: 'le chiffre doit être positif')]
    #[Assert\GreaterThanOrEqual(value: 0, message: 'La valeur doit être supérieure ou égale à 0')]
    #[Assert\LessThanOrEqual(value: 300000, message: 'La valeur doit être inférieure ou égale à 300000')]
    private ?int $mileage = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Assert\LessThanOrEqual(
        value: 'today',
        message: 'La date doit être antérieure à aujourd\'hui'
    )]
    private ?\DateTimeInterface $dateCreation = null;

    #[ORM\Column]
    private ?float $price = null;

    #[ORM\Column(length: 50)]
    #[Assert\NotBlank(message: 'Veuillez saisir une marque')]
    #[Assert\Length(
        min: 3,
        minMessage: 'Le modèle doit contenir au moins {{ limit }} caractères',
        max: 50, 
        maxMessage: 'Le modèle ne peut pas dépasser {{ limit }} caractères')]
    private ?string $modele = null;

    #[ORM\ManyToMany(targetEntity: Equipment::class, inversedBy: 'cars')]
    private Collection $is_equipped;

    #[Vich\UploadableField(mapping: 'cars', fileNameProperty: 'imageName', size: 'imageSize')]
    #[Assert\File(
        maxSize: '1920k',
        mimeTypes: ['jpeg', 'png'],
        maxSizeMessage :"Le fichier est trop volumineux. La taille maximale autorisée est de 1920 Ko.",
        mimeTypesMessage:"Les formats autorisés sont jpeg et png.")]
    private ?File $imageFile = null;

    #[ORM\Column(nullable: true)]
    private ?string $imageName = null;

    #[ORM\Column(nullable: true)]
    private ?int $imageSize = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updated_at = null;

    #[ORM\OneToMany(mappedBy: 'represented_by', targetEntity: CarPictures::class, orphanRemoval: true, cascade: ['persist'])]
    private Collection $carPictures;

    public function __construct()
    {
        $this->is_equipped = new ArrayCollection();
        $this->carPictures = new ArrayCollection();
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

    /**
     * @return Collection<int, CarPictures>
     */
    public function getCarPictures(): Collection
    {
        return $this->carPictures;
    }

    public function addCarPicture(CarPictures $carPicture): static
    {
        if (!$this->carPictures->contains($carPicture)) {
            $this->carPictures->add($carPicture);
            $carPicture->setRepresentedBy($this);
        }

        return $this;
    }

    public function removeCarPicture(CarPictures $carPicture): static
    {
        if ($this->carPictures->removeElement($carPicture)) {
            // set the owning side to null (unless already changed)
            if ($carPicture->getRepresentedBy() === $this) {
                $carPicture->setRepresentedBy(null);
            }
        }

        return $this;
    }



}
