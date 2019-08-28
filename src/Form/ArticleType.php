<?php

namespace App\Form;

use App\Entity\Article;


use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ArticleType extends AbstractType
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
            ->add('content', TextareaType::class, [
                'attr' => [
                    'class' => 'uk-textarea'
                ]
            ])
            ->add('image', FileType::class)
            ->add('imageCaption', TextType::class, [
                'attr' => [
                    'class' => 'uk-input'
                ]
            ])
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'name',
                'attr' => [
                    'class' => 'uk-select uk-form-width-medium'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
