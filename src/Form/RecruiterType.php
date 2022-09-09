<?php

namespace App\Form;

use App\Entity\Address;
use App\Entity\Company;
use App\Entity\Recruiter;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RecruiterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('user_id', EntityType::class, [
                'class' => User::class,
                'label' => 'Votre adresse mail',
                'disabled' => true,
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add(
                $builder->create('company_id', EntityType::class, [
                    'class' => Company::class,
                    'compound' => true,
                    'data_class' => null,
                    'label' => 'Entreprise',
                    'required' => true,
                ])
                    ->add('name', TextType::class, [
                        'required' => true,
                        'label' => "Nom de l'établissement",
                        'attr' => [
                            'class' => 'form-control',
                        ],
                    ])
                    ->add(
                        $builder->create('address_id', EntityType::class, [
                            'compound' => true,
                            'class' => Address::class,
                            'data_class' => null,z
                            'required' => true,
                            'label' => 'Adresse de la société',
                            'attr' => [
                                'class' => 'form-control',
                            ],
                        ])
                            ->add('street_number', IntegerType::class, [
                                'label' => 'Numéro',
                                'required' => true,
                                'attr' => [
                                    'class' => 'form-control',
                                ],
                            ])
                            ->add('street_type', ChoiceType::class, [
                                'choices' => [
                                    'Rue' => 'Rue',
                                    'Boulevard' => 'Boulevard',
                                    'Route' => 'Route',
                                    'Chemin' => 'Chemin',
                                    'Impasse' => 'Impasse',
                                    'Place' => 'Place',
                                ],
                                'required' => true,
                                'label' => 'Type de rue',
                                'attr' => [
                                    'class' => 'form-control',
                                ],
                            ])
                            ->add('street_name', TextType::class, [
                                'label' => 'Nom de la rue',
                                'required' => true,
                                'attr' => [
                                    'class' => 'form-control',
                                ],
                            ])
                            ->add('zip_code', IntegerType::class, [
                                'label' => 'Code Postal',
                                'required' => true,
                                'attr' => [
                                    'class' => 'form-control',
                                ],
                            ])
                            ->add('country', TextType::class, [
                                'label' => 'Pays',
                                'required' => true,
                                'attr' => [
                                    'class' => 'form-control',
                                ],
                            ])
                            ->add('city', TextType::class, [
                                'label' => 'Ville',
                                'required' => true,
                                'attr' => [
                                    'class' => 'form-control',
                                ],
                            ])
                    )
            );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Recruiter::class,
        ]);
    }
}
