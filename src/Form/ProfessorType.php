<?php

namespace App\Form;

use App\Entity\Professor;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class ProfessorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', TextType::class, [
                'attr' => [
                    'class' => 'uk-input'
                ]
            ])
            ->add('lastName', TextType::class, [
                'attr' => [
                    'class' => 'uk-input'
                ]
            ])
            ->add('email', EmailType::class, [
                'attr' => [
                    'class' => 'uk-input'
                ]
            ])
            ->add('phoneNumber', NumberType::class, [
                'attr' => [
                    'class' => 'uk-input'
                ]
            ])
            ->add('mobileNumber', NumberType::class, [
                'attr' => [
                    'class' => 'uk-input'
                ]
            ])
            ->add('address', TextType::class, [
                'attr' => [
                    'class' => 'uk-input'
                ]
            ])
            ->add('postCode', NumberType::class, [
                'attr' => [
                    'class' => 'uk-input'
                ]
            ])
            ->add('city', TextType::class, [
                'attr' => [
                    'class' => 'uk-input'
                ]
            ])
            ->add('image', FileType::class)
            ->add('imageCaption', TextType::class, [
                'attr' => [
                    'class' => 'uk-input'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Professor::class,
        ]);
    }
}
