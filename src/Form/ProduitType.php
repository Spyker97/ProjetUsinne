<?php

namespace App\Form;

use App\Entity\Produit;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('refComplete')
            ->add('numCs')
            ->add('refPrincipale')
            ->add('designation')
            ->add('quantite')
            ->add('qteExpedie')
            ->add('tempsGamme')
            ->add('datePrevu')
            ->add('tempsFacture')
            ->add('PU')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Produit::class,
        ]);
    }
}
