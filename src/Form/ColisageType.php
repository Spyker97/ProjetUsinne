<?php

namespace App\Form;

use App\Entity\Colisage;
use App\Entity\Produit;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ColisageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('remarque')
            ->add('colisage')
            ->add('numOF', EntityType::class, array(
                'class' => Produit::class,
                'choice_label' => 'refComplete',
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Colisage::class,
        ]);
    }
}
