<?php

namespace App\Form;

use App\Entity\Dance;
use App\Entity\Professor;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
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
            ->add('imageFile', VichImageType::class, [
                'required' => false,
                'allow_delete' => true,
                'download_label' => '...',
                'download_uri' => true,
                'image_uri' => true,

            ])
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
