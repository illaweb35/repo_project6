<?php

namespace App\Form;

use NumberFormatter;
use App\Entity\Dance;
use App\Entity\Lesson;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class LessonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'attr' => [
                    'class' => 'uk-input'
                ]
            ])
            ->add('subTitle', TextType::class, [
                'attr' => [
                    'class' => 'uk-input'
                ]
            ])
            ->add('dayLesson', ChoiceType::class, [
                'choices' => [
                    'Lundi'      => 'Lundi',
                    'Mardi'      => 'Mardi',
                    'Mercredi'   => 'Mercredi',
                    'Jeudi'      => 'Jeudi',
                    'Vendredi'   => 'Vendredi',
                    'Samedi'     => 'Samedi',
                    'Dimanche'   => 'Dimanche'
                ],
                'attr' => [
                    'class' => 'uk-select uk-form-width-small'
                ]
            ])
            ->add('startHour', TimeType::class, [
                'input' => 'datetime',
                'widget' => 'choice'
            ])
            ->add('endHour', TimeType::class, [
                'input' => 'datetime',
                'widget' => 'choice'
            ])

            ->add('amount', MoneyType::class, [
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
                    'class' => 'uk-input'
                ]
            ])
            ->add('city', TextType::class, [
                'attr' => [
                    'class' => 'uk-input'
                ]
            ])
            ->add('lat', NumberType::class, [
                'attr' => [
                    'class' => 'uk-input uk-form-width-medium'
                ]
            ])
            ->add('lon', NumberType::class, [
                'attr' => [
                    'class' => 'uk-input uk-form-width-medium'
                ]
            ])
            ->add('dance', EntityType::class, [
                'class' => Dance::class,
                'choice_label' => 'title',
                'attr' => [
                    'class' => 'uk-select uk-form-width-small'
                ]
            ]);;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Lesson::class,
        ]);
    }
}
