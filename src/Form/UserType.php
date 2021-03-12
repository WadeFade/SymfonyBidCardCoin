<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email')
            ->add('roles', ChoiceType::class, [
                'choices' => [
                    'User' => 'ROLE_USER',
                    'Commissaire' => 'ROLE_COMMISSAIRE',
                    'Admin' => 'ROLE_ADMIN',
                    'Super' => 'ROLE_SUPER_ADMIN',
                ],
                'expanded' => true,
                'multiple' => true,
            ])
            ->add('nom')
            ->add('prenom')
            ->add('dateNaissance', BirthdayType::class)
            ->add('telephone')
            ->add('verifIdentite')
            ->add('modePaiement')
            ->add('adresses');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
