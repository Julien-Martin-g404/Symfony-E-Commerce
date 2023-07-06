<?php

namespace App\Form;

use App\Entity\Users;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
{
    $builder
        ->add('email', EmailType::class, [
            'attr' => ['class' => 'form-control', 'placeholder' => 'E-mail'],
            'label' => false,
        ])
        ->add('lastname', TextType::class, [
            'attr' => ['class' => 'form-control', 'placeholder' => 'Nom'],
            'label' => false,
        ])
        ->add('firstname', TextType::class, [
            'attr' => ['class' => 'form-control', 'placeholder' => 'Prénom'],
            'label' => false,
        ])
        ->add('address', TextType::class, [
            'attr' => ['class' => 'form-control', 'placeholder' => 'Adresse'],
            'label' => false,
        ])
        ->add('zipcode', TextType::class, [
            'attr' => ['class' => 'form-control', 'placeholder' => 'Code postal'],
            'label' => false,
        ])
        ->add('city', TextType::class, [
            'attr' => ['class' => 'form-control', 'placeholder' => 'Ville'],
            'label' => false,
        ])
        ->add('RGPDConsent', CheckboxType::class, [
            'mapped' => false,
            'constraints' => [
                new IsTrue([
                    'message' => 'Vous devez accepter nos conditions.',
                ]),
            ],
            'label' => 'Je donne mon consentement au traitement de mes données conformément au RGPD.',
        ])
        ->add('plainPassword', PasswordType::class, [
            'mapped' => false,
            'attr' => [
                'autocomplete' => 'new-password',
                'class' => 'form-control',
                'placeholder' => 'Mot de passe',
            ],
            'constraints' => [
                new NotBlank([
                    'message' => 'Veuillez entrer un mot de passe.',
                ]),
                new Length([
                    'min' => 6,
                    'minMessage' => 'Votre mot de passe doit contenir au moins {{ limit }} caractères.',
                    'max' => 4096,
                ]),
            ],
            'label' => false,
        ]);
}


    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Users::class,
        ]);
    }
}