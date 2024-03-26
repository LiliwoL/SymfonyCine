<?php

namespace App\Form;

use App\Entity\Movie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MovieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', null, [
                'label' => false,                   // On n'affichera pas le label
                'attr' => [
                    'hidden' => 'hidden'            // Le champ sera masqué
                ]
            ])
            ->add('overview', null, [
                'label' => false,                   // On n'affichera pas le label
                'attr' => [
                    'hidden' => 'hidden'            // Le champ sera masqué
                ]
            ])
            ->add('poster_path', null, [
                'label' => false,                   // On n'affichera pas le label
                'attr' => [
                    'hidden' => 'hidden'            // Le champ sera masqué
                ]
            ])

            // Ajout du bouton de validation
            ->add('save', SubmitType::class, [
                'label' => 'Enregistrer ce film en base de données',
                'attr' => [
                    'class' => 'save btn btn-primary'
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Movie::class,
        ]);
    }
}
