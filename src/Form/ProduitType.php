<?php

namespace App\Form;

use App\Entity\Produit;
use App\Entity\ProduitName;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
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
            ->add('pname')
            ->add('produitName', EntityType::class, array(
                'class' => ProduitName::class,
                'choice_label' => 'produitName',
            ))
            ->add('designation')
            ->add('quantite')
            ->add('qteExpedie')
            ->add('tempsGamme')
            ->add('datePrevu',DateType::class,[
                'widget' => 'single_text',



                // prevents rendering it as type="date", to avoid HTML5 date pickers
                'html5' => true ,
                'required' => true,
                'empty_data' => '01/01/2000',])
            ->add('tempsFacture')
            ->add('PU')
            ->add('volume')
            ->add('poid')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Produit::class,
        ]);
    }
}
