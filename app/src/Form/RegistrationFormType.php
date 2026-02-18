<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', TextType::class, [
                'label' => 'Prénom',
                'attr' => [
                    'placeholder' => 'Entrez votre prénom',
                    'class' => 'form-control mb-3 border-input'
                ],
                'label_attr' => [
                    'class' => 'd-block text-center text-white'
                ]
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Nom',
                'attr' => [
                    'placeholder' => 'Entrez votre nom',
                    'class' => 'form-control mb-3 border-input'
                ],
                'label_attr' => [
                    'class' => 'd-block text-center text-white'
                ]
            ])
            ->add('phone', TelType::class, [
                'label' => 'Téléphone',
                'attr' => [
                    'placeholder' => 'Entrez votre numéro de téléphone',
                    'class' => 'form-control mb-3 border-input'
                ],
                'label_attr' => [
                    'class' => 'd-block text-center text-white'
                ]
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'attr' => [
                    'placeholder' => 'Entez votre email',
                    'class' => 'form-control mb-3 border-input'
                ],
                'label_attr' => [
                    'class' => 'd-block text-center text-white'
                ]
            ])
            ->add('isPassenger', CheckboxType::class, [
                'label' => 'Passager',
                'label_attr' => [
                    'class' => 'd-block text-center text-white'
                ],
                'required' => false
            ])
            ->add('isDriver', CheckboxType::class, [
                'label' => 'Conducteur',
                'label_attr' => [
                    'class' => 'd-block text-center text-white'
                ],
                'required' => false
            ])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'label' => 'Mot de passe',
                'label_attr' => [
                    'class' => 'd-block text-center text-white'
                ],
                'mapped' => false,
                'attr' => [
                    'autocomplete' => 'new-password',
                    'placeholder' => 'Entrez votre mot de passe',
                    'class' => 'form-control mb-3 border-input'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Le mot de passe ne peut pas être vide',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Le mot de passe doit comporter au minimum {{ limit }} cara',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
