<?php

namespace App\Form;

use App\Entity\Dance;
use App\Entity\Professor;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class DanceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'attr' => ['class' => 'uk-input']
            ])
            ->add('subTitle', TextType::class, [
                'attr' => ['class' => 'uk-input']
            ])
            ->add('content', TextareaType::class, [
                'attr' => ['class' => 'uk-textarea']
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
                'attr' => ['class' => 'uk-input']
            ])
            ->add('professor', EntityType::class, [
                'class' => Professor::class,
                'choice_label' => 'firstName'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Dance::class,
        ]);
    }
}
