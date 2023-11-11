<?php

namespace App\Controller\Admin;

use App\Entity\Reviews;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ReviewsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Reviews::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        
        yield IdField::new('id')->hideOnForm()->hideOnIndex();
        yield TextField::new('author')->setLabel('pseudo');
        yield TextEditorField::new('comment')->setLabel('commentaire');
        yield BooleanField::new('is_approved')->setLabel('approuvé');
        yield IntegerField::new('note')
            ->setLabel('Note')
            ->setFormTypeOptions([
                'attr' => [
                    'min' => 1,
                    'max' => 5,
                    'step' => 1,
                ],
            ]);
    }
    
}
