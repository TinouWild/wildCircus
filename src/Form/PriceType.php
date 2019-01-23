<?php

namespace App\Form;

use App\Entity\Period;
use App\Entity\Prix;
use App\Entity\Visitors;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PriceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('price', IntegerType::class, [
                'attr' => [
                    'placeholder' => 'Prix',
                    'min' => 0,
                    'step' => 1
                ]
            ])
            ->add('visitor', EntityType::class, [
                'class' => Visitors::class,
                'choice_label' => 'type',
                'required' => false,
                'attr' => ['class' => 'selectpicker']
            ])
            ->add('period', EntityType::class, [
                'class' => Period::class,
                'choice_label' => 'name',
                'required' => false,
                'attr' => ['class' => 'selectpicker']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Prix::class,
        ]);
    }
}
