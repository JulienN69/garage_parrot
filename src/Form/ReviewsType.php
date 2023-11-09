<?php

namespace App\Form;

use App\Entity\Reviews;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ReviewsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('author', null, [
            'label' => 'Pseudo',
            'attr' => ['class' => 'form-control', 'placeholder' => 'Entrez votre pseudo']
        ])
        ->add('comment', TextareaType::class, [
            'label' => 'Commentaire',
            'attr' => [
                'class' => 'form-control', 
                'rows' => 4,
                 'placeholder' => 'Saisissez votre commentaire'
                 ]
        ])
        ->add('note', ChoiceType::class, [
            'label' => 'Note',
            'choices' => [
                '0' => 1,
                '1' => 2,
                '2' => 3,
                '3' => 4,
                '4' => 5,
                '5' => 6,
            ],
            'attr' => ['class' => 'form-control']
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reviews::class,
        ]);
    }
}
