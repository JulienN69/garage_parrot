<?php

namespace App\Controller\Admin;

use App\Entity\Services;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Vich\UploaderBundle\Form\Type\VichImageType;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use Symfony\Component\Validator\Constraints as Assert;


class ServicesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Services::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('service_title');
        yield TextField::new('description');
        yield NumberField::new('price');
        yield TextareaField::new('imageFile')
            ->setFormType(VichImageType::class)
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
            ]);
        yield ImageField::new('imageName')->setBasePath('images/')->hideOnForm();
    }
}
