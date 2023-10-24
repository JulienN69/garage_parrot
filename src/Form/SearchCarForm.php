<?php

namespace App\Form;

use App\Data\SearchCarData;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class SearchCarForm extends AbstractType
{   
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('priceMin', RangeType::class, [
            'label' => false,
            'attr' => [
                'min' => 0,      
                'max' => 150000,    
                'step' => 500,
                'class'=> 'filter-button__input',
                'value'=> '0'     
            ]
            ])
            ->add('priceMax', RangeType::class, [
            'label' => false,
            'attr' => [
                'min' => 0,      
                'max' => 150000,    
                'step' => 500,
                'class'=> 'filter-button__input',
                'value'=> '150000'     
            ]
            ])
            ->add('milesMin', RangeType::class, [
            'label' => false,
            'attr' => [
                'min' => 0,      
                'max' => 200000,    
                'step' => 500,
                'class'=> 'filter-button__input',
                'value'=> '0'     
            ]
            ])
            ->add('milesMax', RangeType::class, [
            'label' => false,
            'attr' => [
                'min' => 0,      
                'max' => 200000,    
                'step' => 500,
                'class'=> 'filter-button__input',
                'value'=> '200000'     
            ]
            ])
            ->add('yearMin', NumberType::class, [
                'label' => false,
                'required'=> false,
                'html5' => true,
                'attr' => [
                    'min' => 1980, 
                    'max' => 2023, 
                ],
                'invalid_message'=> 'donnée invalide, veuillez entrer une année entre 1980 et 2023',
                'attr'=> [
                    'placeholder'=> 'Année min'
                ]
            ])
            ->add('yearMax', NumberType::class, [
                'label' => false,
                'required'=> false,
                'html5' => true,
                'attr' => [
                    'min' => 1980, 
                    'max' => 2023, 
                ],
                'invalid_message'=> 'donnée invalide, veuillez entrer une année entre 1980 et 2023',
                'attr'=> [
                    'placeholder'=> 'Année max'
                ]
            ]);               
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SearchCarData::class,
            'method' => 'GET',
            'csrf_protection' => false
        ]);
        
    }
}