<?php

namespace App\Form;

use App\Entity\Car;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;

class CarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('mileage', IntegerType::class, [
                'label' => 'kilométrage'
            ], [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez saisir une marque',
                    ]),
                ],
                'required' => false,
            ])
            ->add('dateCreation', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Date de mise en service'
            ])
            ->add('price', MoneyType::class, [
                'label' => 'prix'
            ])
            ->add('modele', TextType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez saisir une marque',
                    ]),
                ],
                'required' => false,
            ])
            // ->add('is_equipped')
            ->add('valider', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Car::class,
        ]);
    }
}
