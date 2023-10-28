<?php

namespace App\Controller\Admin;

use App\Entity\Contact;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ContactCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Contact::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
       
            yield IdField::new('id')->hideOnForm()->hideOnIndex();
            yield TextField::new('first_name')->setLabel('prénom');
            yield TextField::new('last_name')->setLabel('nom');
            yield TextField::new('email');
            yield TextField::new('phone')->setLabel('téléphone');
            yield TextField::new('message_title')->setLabel('sujet');
            yield TextareaField::new('message_content')->setLabel('message');
       
    }
    
}
