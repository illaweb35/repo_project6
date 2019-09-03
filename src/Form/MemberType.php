<?php

namespace App\Form;

use App\Entity\Lesson;
use App\Entity\Member;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
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
            ->add('email', EmailType::class, [
                'attr' => [
                    'class' => 'uk-input uk-form-width-medium'
                ]
            ])
            ->add('phoneNumber', TextType::class, [
                'attr' => [
                    'class' => 'uk-input uk-form-width-small'
                ]
            ])
            ->add('mobileNumber', TextType::class, [
                'attr' => [
                    'class' => 'uk-input uk-form-width-small'
                ]
            ])
            ->add('address', TextType::class, [
                'attr' => [
                    'class' => 'uk-input'
                ]
            ])
            ->add('postCode', TextType::class, [
                'attr' => [
                    'class' => 'uk-input uk-form-width-small'
                ]
            ])
            ->add('city', TextType::class, [
                'attr' => [
                    'class' => 'uk-input uk-form-width-small'
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
                    'class' => 'uk-input .uk-form-width-small'
                ]
            ])
            ->add('lesson', EntityType::class, [
                'class' => Lesson::class,
                'attr' => [
                    'class' => 'uk-select uk-form-width-medium'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Member::class,
        ]);
    }
}
