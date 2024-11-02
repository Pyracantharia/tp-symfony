<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('username', TextType::class, [
            'label' => false,
            'attr' => [
                'class' => 'w-full px-8 py-4 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-500 text-sm focus:outline-none focus:border-gray-400 focus:bg-white',
                'placeholder' => 'Nom d\'utilisateur'
            ],
        ])
        ->add('email', EmailType::class, [
            'label' => false,
            'attr' => [
                'class' => 'w-full px-8 py-4 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-500 text-sm focus:outline-none focus:border-gray-400 focus:bg-white',
                'placeholder' => 'Adresse Email'
            ],
        ])
        ->add('phoneNumber', TextType::class, [
            'label' => false,
            'attr' => [
                'class' => 'w-full px-8 py-4 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-500 text-sm focus:outline-none focus:border-gray-400 focus:bg-white',
                'placeholder' => 'Numéro de téléphone'
            ],
        ])
        ->add('address', TextType::class, [
            'label' => false,
            'attr' => [
                'class' => 'w-full px-8 py-4 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-500 text-sm focus:outline-none focus:border-gray-400 focus:bg-white',
                'placeholder' => 'Adresse'
            ],
        ])
        ->add('postalCode', TextType::class, [
            'label' => false,
            'attr' => [
                'class' => 'w-1/2 px-8 py-4 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-500 text-sm focus:outline-none focus:border-gray-400 focus:bg-white',
                'placeholder' => 'Code Postal'
            ],
        ])
        ->add('city', TextType::class, [
            'label' => false,
            'attr' => [
                'class' => 'w-1/2 px-8 py-4 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-500 text-sm focus:outline-none focus:border-gray-400 focus:bg-white',
                'placeholder' => 'Ville'
            ],
        ])
        ->add('password', PasswordType::class, [
            'label' => false,
            'attr' => [
                'class' => 'w-full px-8 py-4 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-500 text-sm focus:outline-none focus:border-gray-400 focus:bg-white',
                'placeholder' => 'Mot de passe'
            ],
        ])
        ->add('repeatedPassword', PasswordType::class, [
            'label' => false,
            'mapped' => false,
            'attr' => [
                'class' => 'w-full px-8 py-4 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-500 text-sm focus:outline-none focus:border-gray-400 focus:bg-white',
                'placeholder' => 'Confirmez votre Mot de passe'
            ],
        ])
        ->add('terms', CheckboxType::class, [
            'label' => 'Cocher  pour accepter les termes et conditions ',
            'mapped' => false,
            'attr' => [
                'class' => 'mr-2'
            ],
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}