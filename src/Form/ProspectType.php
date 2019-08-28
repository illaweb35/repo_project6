<?php

namespace App\Form;

use App\Entity\Prospect;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ProspectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', TextType::class, [
                'attr' => [
                    'class' => 'uk-input',
                    'placeholder' => 'Votre prénom'
                ]
            ])
            ->add('lastName', TextType::class, [
                'attr' => [
                    'class' => 'uk-input',
                    'placeholder' => 'Votre Nom'
                ]
            ])
            ->add('email', EmailType::class, [
                'attr' => [
                    'class' => 'uk-input',
                    'placeholder' => 'Votre email'
                ]
            ])
            ->add('phoneNumber', TextType::class, [
                'attr' => [
                    'class' => 'uk-input',
                    'placeholder' => 'Votre tel'
                ]
            ])
            ->add('subject', ChoiceType::class, [
                'choices' => [
                    'Demande d\'informations' => "information",
                    'Demande divers' => "divers",
                ],
                'attr' => [
                    'class' => 'uk-select uk-form-width-medium'
                ]
            ])
            ->add('content', TextareaType::class, [
                'attr' => [
                    'class' => 'uk-textarea',
                    'rows' => '5'
                ]
            ])
            ->add('agreeRgpd', CheckboxType::class, [
                'required' => true,
                'attr' => [
                    'type' => 'uk-checkbox',
                    'class' => 'uk-checkbox'

                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Prospect::class,
        ]);
    }
}
