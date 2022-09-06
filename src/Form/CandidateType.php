<?php

namespace App\Form;

use App\Entity\Candidate;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CandidateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Prénom',

            ])
            ->add('lastname', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Nom de Famille',

            ])
            ->add('cvFile', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Mon CV',

            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Candidate::class,
        ]);
    }
}
