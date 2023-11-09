<?php

namespace App\Controller\Admin;

use App\Entity\Car;
use App\Form\Type\CarImageType;
use App\Uploader\CarDirectoryNamer;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use Vich\UploaderBundle\Form\Type\VichImageType;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use Symfony\Component\Validator\Constraints as Assert;


class CarCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Car::class;
    }

    public function configureFields(string $pageName): iterable
    {
        // yield from parent::configureFields($pageName);
        
        yield IdField::new('id')->hideOnForm()->hideOnIndex();
        yield TextField::new('modele')->setLabel('modèle');
        yield IntegerField::new('mileage')->setLabel('kilométrage');
        yield IntegerField::new('price')->setLabel('prix');
        yield DateField::new('dateCreation')->renderAsChoice()
            ->setLabel('Date de création')
            ->setFormTypeOptions([
                'html5' => true,
                'years' => range(1980, date('Y')),
            ]);
        yield IntegerField::new('power')->setLabel('puissance')->hideOnIndex();
        yield IntegerField::new('gatesNumber')->setLabel('nombre de portes')->hideOnIndex();
        yield Field::new('gatesNumber', 'nombre de portes')
            ->setFormType(ChoiceType::class)
            ->hideOnIndex()
            ->setFormTypeOptions([
                'choices' => [
                    '3' => '3',
                    '5' => '5',
                ],
            ]);
        yield NumberField::new('length')->setLabel('longueur')->hideOnIndex();
        yield Field::new('energy', 'énergie')
            ->setFormType(ChoiceType::class)
            ->hideOnIndex()
            ->setFormTypeOptions([
                'choices' => [
                    'Essence' => 'essence',
                    'Diesel' => 'diesel',
                    'Électrique' => 'electrique',
                ],
            ]);
        yield Field::new('thumnailCritair', 'vignette crit\'air')
            ->setFormType(ChoiceType::class)
            ->hideOnIndex()
            ->setFormTypeOptions([
                'choices' => [
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5',
                ],
            ]);
        yield TextField::new('color')->setLabel('couleur')->hideOnIndex();
        yield TextField::new('origin')->setLabel('provenance')->hideOnIndex();

        yield TextareaField::new('imageFile')->setFormType(VichImageType::class)
            ->hideOnIndex()
            ->setFormTypeOptions([
                'constraints' => [
                    new Assert\File([
                        'maxSize' => '1920k',
                        'mimeTypes' => ['image/jpeg', 'image/jpg', 'image/png'],
                        'maxSizeMessage' => "Le fichier est trop volumineux. La taille maximale autorisée est de 1920 Ko.",
                        'mimeTypesMessage' => "Les formats autorisés sont jpg et png."
                    ])
                ]
            ])
            ->setLabel('photo principale');
        yield ImageField::new('imageName')
        ->formatValue(function ($value, $entity) {
            if ($entity instanceof Car) {
                $imageName = $entity->getImageName();
    
                if ($imageName) {
                    $directoryNamer = new CarDirectoryNamer();                    
                    $directory = $directoryNamer->directoryName($entity, null);
    
                    if ($directory) {
                        return '/images/cars/' . $directory . '/' . $imageName;
                    }
                }
            }
    
            return '/images/voiture.jpg';
        })
            ->setBasePath('/images/cars/')
            ->hideOnForm()
            ->setLabel('photo principale');

        yield AssociationField::new('is_equipped')->setLabel('équipements');

        yield CollectionField::new('carPictures', 'autres photos')
        ->setEntryType(CarImageType::class);

    }

}
