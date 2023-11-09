<?php

namespace App\Form\Type;

use App\Entity\CarPictures;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\Validator\Constraints as Assert;

class CarImageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options):void
    {
        $builder->add('picture_file', VichImageType::class, [
            'label' => 'Image',
            'constraints' => [
                new Assert\File([
                    'maxSize' => '2M',
                    'mimeTypes' => ['image/jpeg', 'image/jpg', 'image/png'], 
                    'maxSizeMessage' => 'Le fichier est trop volumineux. La taille maximale autorisée est de 2 Mo.',
                    'mimeTypesMessage' => 'Les formats autorisés sont JPEG, JPG et PNG.',
                ]),
            ],
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class'=>CarPictures::class
        ]);
    }
}



