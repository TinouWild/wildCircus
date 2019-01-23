<?php

namespace App\Form;

use App\Entity\Performance;
use App\Entity\Performers;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class PerformanceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label' => false,
                'attr' => ['placeholder' => 'Titre du spectacle']
            ])
            ->add('date', DateType::class, [
                'widget' => 'single_text',
                'label' => false
            ])
            ->add('time', TimeType::class, [
                'label' => false,
                'widget' => 'single_text'
            ])
            ->add('backgroundFile', VichImageType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'Image mise en avant',
                    'type' => 'file'
                ]])
            ->add('performers', EntityType::class, [
                'class' => Performers::class,
                'expanded' => true,
                'multiple' => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Performance::class,
        ]);
    }
}
