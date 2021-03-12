<?php

namespace App\Form;

use App\Entity\Produit;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomProduit')
            ->add('description')
            ->add('prixReserve')
            ->add('prixDepart')
            ->add('prixVente')
            ->add('estVendu')
            ->add('enStock')
            ->add('nbInvendu')
            ->add('categorie')
            ->add('lot')
            ->add('stockage')
            ->add('vendeur')
            ->add('acquereur')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Produit::class,
        ]);
    }
}
