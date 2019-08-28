<?php

namespace App\Form;

use App\Entity\Lesson;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LessonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('slug')
            ->add('subTitle')
            ->add('dayLesson')
            ->add('startHour')
            ->add('endHour')
            ->add('duration')
            ->add('amount')
            ->add('address')
            ->add('postCode')
            ->add('city')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('imageCaption')
            ->add('dance')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Lesson::class,
        ]);
    }
}
