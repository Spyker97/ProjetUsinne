<?php

namespace App\Form;

use App\Entity\ProdFact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProdFactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('datePrevu',DateType::class,[
                'widget' => 'single_text',



                // prevents rendering it as type="date", to avoid HTML5 date pickers
                'html5' => true ,
                'required' => true,
                'empty_data' => '01/01/2000',])
            ->add('factureExport')
            ->add('declarDouane')


        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ProdFact::class,
        ]);
    }
}
