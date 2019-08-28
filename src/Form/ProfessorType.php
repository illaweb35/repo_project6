<?php

namespace App\Form;

use App\Entity\Professor;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProfessorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName')
            ->add('lastName')
            ->add('email')
            ->add('image')
            ->add('phoneNumber')
            ->add('mobileNumber')
            ->add('address')
            ->add('postCode')
            ->add('city')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('imageCaption')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Professor::class,
        ]);
    }
}
