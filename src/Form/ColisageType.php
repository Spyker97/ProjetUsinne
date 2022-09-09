<?php

namespace App\Form;

use App\Entity\Colisage;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ColisageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('reference')
            ->add('quantite')
            ->add('remarque')
            ->add('colisage')
            ->add('numColi')
            ->add('numOF')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Colisage::class,
        ]);
    }
}
