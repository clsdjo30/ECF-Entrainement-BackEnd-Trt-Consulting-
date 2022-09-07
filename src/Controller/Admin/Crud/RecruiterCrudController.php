<?php

namespace App\Controller\Admin\Crud;

use App\Entity\Recruiter;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;

class RecruiterCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Recruiter::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Recruteurs')
            ->setEntityLabelInSingular('Recruteur')
            ->setPageTitle('index', 'Tous les %entity_label_plural%')
            ->setPageTitle('edit', 'Compléter mon profil')
            ->setPaginatorPageSize(15)
            ->setDateFormat('dd:MM:yyyy')
            ->showEntityActionsInlined()
            ->setDefaultSort(['id' => 'desc']);
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnIndex()->onlyOnForms(),
            AssociationField::new('user_id', 'Recruteurs'),
            CollectionField::new('company_id', "Nom de l'entreprise"),
            CollectionField::new('publishValidation', 'Annonces validés'),
            CollectionField::new('announce_id', 'Annonces'),

        ];
    }


}
