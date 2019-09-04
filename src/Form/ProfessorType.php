<?php

namespace App\Form;

use App\Entity\Professor;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;


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
            ->add('phoneNumber', TextType::class, [
                'attr' => [
                    'class' => 'uk-input'
                ]
            ])
            ->add('mobileNumber', TextType::class, [
                'attr' => [
                    'class' => 'uk-input'
                ]
            ])
            ->add('address', TextType::class, [
                'attr' => [
                    'class' => 'uk-input'
                ]
            ])
            ->add('postCode', TextType::class, [
                'attr' => [
                    'class' => 'uk-input'
                ]
            ])
            ->add('city', TextType::class, [
                'attr' => [
                    'class' => 'uk-input'
                ]
            ])
            ->add('imageFile', VichImageType::class, [
                'required' => false,
                'allow_delete' => true,
                'download_label' => '...',
                'download_uri' => true,
                'image_uri' => true,

            ])
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
