<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Movie;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MovieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre',
            ])
            ->add('synopsis', TextareaType::class, [
                'label' => 'Synopsis',
                'required' => false,
            ])
            ->add('duration', NumberType::class, [
                'label' => 'Durée (en minutes)',
            ])
            ->add('releaseDate', DateType::class, [
                'label' => 'Date de sortie',
                'widget' => 'single_text',
            ])
            ->add('pressRating', NumberType::class, [
                'label' => 'Note presse',
                'required' => false,
                'html5' => true,
                'attr' => [
                    'step' => '0.1',
                    'min' => 0,
                    'max' => 5,
                ],
            ])
            ->add('poster', UrlType::class, [
                'label' => 'URL de l’affiche',
                'required' => false,
            ])
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'name',
                'label' => 'Catégorie',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Movie::class,
        ]);
    }
}