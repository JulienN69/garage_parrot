<?php

namespace App\Controller\Admin;

use App\Entity\Car;
use App\Form\Type\CarImageType;
use App\Uploader\CarDirectoryNamer;
use Vich\UploaderBundle\Form\Type\VichImageType;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

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

        yield TextareaField::new('imageFile')->setFormType(VichImageType::class)->hideOnIndex()->setLabel('photo principale');
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
    
            return '/images/autres';
        })
            ->setBasePath('/images/cars/')
            ->hideOnForm()
            ->setLabel('photo principale');

        yield AssociationField::new('is_equipped')->setLabel('équipements');

        yield CollectionField::new('carPictures', 'autres photos')
        ->setEntryType(CarImageType::class);

    }

}
