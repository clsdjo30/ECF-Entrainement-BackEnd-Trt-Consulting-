<?php

namespace App\Controller\Admin\Crud;

use App\Entity\Company;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CompanyCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Company::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Nom des Entreprises')
            ->setEntityLabelInSingular("Nom de l'entreprise")
            ->setPageTitle('index', 'Toutes les %entity_label_plural%')
            ->setPaginatorPageSize(15)
            ->setDateFormat('dd:MM:yyyy')
            ->showEntityActionsInlined()
            ->setDefaultSort(['id' => 'desc']);
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')->hideOnIndex()->hideOnForm()->hideOnDetail();
        yield AssociationField::new('recruiter', 'Email ')
            ->setCrudController(RecruiterCrudController::class);
        yield TextField::new('name', 'Sociétés');
        yield AssociationField::new('address_id', 'Adresses');

    }


}
