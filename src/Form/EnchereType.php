<?php

namespace App\Form;

use App\Entity\Enchere;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EnchereType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dateEnchere')
            ->add('prixPropose')
            ->add('estAdjuge')
            ->add('lot')
            ->add('ordreAchat')
            ->add('salleVente')
            ->add('paiement')
            ->add('commissaire')
            ->add('encherisseur')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Enchere::class,
        ]);
    }
}
