<?php

namespace App\Controller\Admin\Crud;

use App\Entity\ApplyValidation;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;

class ApplyValidationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ApplyValidation::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Validations de Candidatures')
            ->setEntityLabelInSingular('Validation de Candidature')
            ->setPageTitle('index', 'Toutes les %entity_label_plural%')
            ->setPaginatorPageSize(10)
            ->setDateFormat('dd:MM:yyyy')
            ->showEntityActionsInlined()
            ->setDefaultSort(['id' => 'desc']);
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnIndex()->onlyOnForms()->hideWhenUpdating(),
            AssociationField::new('candidate', 'Candidat'),
            AssociationField::new('announce', 'Annonce'),
            BooleanField::new('candidateIsValid', 'Validé'),

        ];
    }


}
