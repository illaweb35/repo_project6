<?php

namespace App\Form;

use App\Entity\Member;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MemberType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('userFirstName')
            ->add('userLastName')
            ->add('birthday')
            ->add('image')
            ->add('civility')
            ->add('firstName')
            ->add('lastName')
            ->add('email')
            ->add('phoneNumber')
            ->add('mobileNumber')
            ->add('address')
            ->add('postCode')
            ->add('city')
            ->add('infos')

            ->add('imageCaption')
            ->add('lesson');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Member::class,
        ]);
    }
}
