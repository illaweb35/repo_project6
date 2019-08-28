<?php

namespace App\Form;

use App\Entity\Dance;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DanceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('slug')
            ->add('subTitle')
            ->add('content')
            ->add('image')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('imageCaption')
            ->add('professor')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Dance::class,
        ]);
    }
}
