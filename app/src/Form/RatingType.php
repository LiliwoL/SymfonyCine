<?php

namespace App\Form;

use App\Entity\Rating;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RatingType extends AbstractType
{

    // https://symfony.com/doc/current/reference/forms/types.html
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        // On définit chaque champ du formulaire ici à l'aide de la méthode add()
        // https://symfony.com/doc/current/reference/forms/types.html
        $builder
            ->add('idMovie', NumberType::class, [
                'label' => 'Identifiant du film',
                'attr' => [
                    'readonly' => true
                ]
            ])
            ->add('nickname', TextType::class, [
                'label' => 'Pseudo'
            ])
            ->add('rate', RangeType::class, [
                'label' => 'Note (0 à 5)',
                'attr' => [
                    'min' => 0,
                    'max' => 5
                ]
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Noter',
                'attr' => ['class' => 'save'],
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Rating::class,
        ]);
    }
}
