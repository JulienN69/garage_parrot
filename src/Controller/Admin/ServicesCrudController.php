<?php

namespace App\Controller\Admin;

use App\Entity\Services;
use Vich\UploaderBundle\Form\Type\VichImageType;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

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

        yield TextareaField::new('imageFile')->setFormType(VichImageType::class);
    }
}
