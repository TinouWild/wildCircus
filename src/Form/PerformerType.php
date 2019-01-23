<?php

namespace App\Form;

use App\Entity\Performers;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class PerformerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', TextType::class, [
                'label' => false,
                'attr' => ['placeholder' => "Prénom"]
            ])
            ->add('lastname', TextType::class, [
                'label' => false,
                'attr' => ['placeholder' => "Nom"]
            ])
            ->add('avatarFile', VichImageType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'Avatar',
                    'type' => 'file'
                ]
            ])
            ->add('biography', CKEditorType::class, [
                'label' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Performers::class,
        ]);
    }
}
