<?php

namespace App\Form;

use App\Entity\Member;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class MemberType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('userFirstName', TextType::class, [
                'attr' => [
                    'class' => 'uk-input'
                ]
            ])
            ->add('userLastName', TextType::class, [
                'attr' => [
                    'class' => 'uk-input'
                ]
            ])
            ->add('birthday', BirthdayType::class)
            ->add('civility', ChoiceType::class, [
                'choices' => [
                    'Mr' => 'monsieur',
                    'Mme' => 'madame',
                    'Dr' => 'docteur'

                ]
            ])
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
            ->add('email', EmailType::class)
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
            ->add('postCode')
            ->add('city', TextType::class, [
                'attr' => [
                    'class' => 'uk-input'
                ]
            ])
            ->add('infos', TextareaType::class, [
                'attr' => [
                    'class' => 'uk-textarea',
                    'rows' => '3'
                ]
            ])
            ->add(
                'image',
                FileType::class,
                [
                    'label' => 'image',
                    'mapped' => false,
                    'required' => false,
                    'constraints' => [
                        new File([
                            'maxSize' => '2M',
                        ])
                    ],
                ]
            )
            ->add('imageCaption', TextType::class, [
                'attr' => [
                    'class' => 'uk-input'
                ]
            ])
            ->add('lesson');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Member::class,
        ]);
    }
}
