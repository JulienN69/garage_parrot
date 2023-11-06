<?php

namespace App\Form\Type;

use App\Entity\Car;
use App\Entity\Equipment;
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
            ->add('équipements', EntityType::class, [
                'label'     => 'Liste',
                'class'         => Equipment::class,  // FQCN de l'entité
                'choice_label'  => 'libelle', // Attributs de l'entité (ie: colonne de la table)
                'mapped'        => true, // valeur par défaut
                'placeholder'   => 'Choisir un ou plusieurs équipements',
                'expanded'      => false, // valeur par défaut. Checkox ou radio si true
                'multiple'      => true, // valeur par défaut. Choix multiple si true (=> checkbox et bouton radio si false)
            ])
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
