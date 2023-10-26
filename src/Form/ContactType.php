<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('last_name')
            ->add('first_name')
            ->add('email', null, [ 'label' => 'adresse mail'])
            ->add('phone', null, [ 'label' => 'téléphone'])
            ->add('message_title', null, [ 'label' => 'sujet'])
            ->add('message_content', TextareaType::class, [
                'attr' => ['rows' => 6], 
                'label' => 'message',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
            'method' => 'POST'
        ]);
    }
}
