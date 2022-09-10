<?php

namespace App\Form;

use App\Entity\Announce;
use App\Entity\Category;
use App\Entity\Recruiter;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AnnounceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('recruiter', EntityType::class, [
                'class' => Recruiter::class,
                'disabled' => true,
            ])
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'label' => 'Choisissez la catégorie de votre annonce',
                'attr' => [
                    'class' => 'form-control',

                ],
            ])
            ->add('title', ChoiceType::class, [
                'multiple' => false,
                'label' => 'Type de contrat',
                'choices' => [
                    'Recherche pour contrat  CDI' => 'Recherche pour contrat  CDI',
                    'Recherche pour contrat  CDD' => 'Recherche pour contrat en CDD',
                    'Recherche pour mission Interim' => 'Recherche pour mission Interim',
                    'Recherche pour Remplacement' => 'Recherche pour Remplacement',
                ],
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description de votre poste',
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('experience', ChoiceType::class, [
                'multiple' => false,
                'choices' => [
                    'Minimum - 1 ans' => 'Minimum - 1 ans',
                    'Minimum - 5 ans' => 'Minimum - 5 ans',
                    'Souhaitée de 1 ans' => 'Souhaitée de 1 ans',
                    'Souhaitée de 3 ans' => 'Souhaitée de 3 ans',
                    'Souhaitée de 5 ans' => 'Souhaitée de 3 ans',
                    'Exigée de 5 ans' => 'Exigée de 5 ans',
                    'Exigée de 10 ans' => 'Exigée de 10 ans',
                ],
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('salary', IntegerType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('benefits', ChoiceType::class, [
                'label' => 'Avantages',
                'choices' => [
                    'Ticket restaurant' => 'Ticket restaurant',
                    'Logé' => 'Logé',
                    'Nouri' => 'Nouri',
                    'Blanchi' => 'Blanchi',
                    '13iem mois' => '13iem mois',
                    'Prime sur ratio' => 'Prime sur ratio',
                ],
                'attr' => [
                    'class' => 'form-select',
                ],

            ])
            ->add('hourly', ChoiceType::class, [
                'multiple' => false,
                'choices' => [
                    'Horaire en coupure' => 'Horaire en coupure',
                    'Horaire continue journée' => 'Horaire continue journée',
                    'Horaire continue soirée' => 'Horaire continue soirée',
                ],
                'attr' => [
                    'class' => 'form-control',
                ],
            ]);

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Announce::class,
        ]);
    }
}
