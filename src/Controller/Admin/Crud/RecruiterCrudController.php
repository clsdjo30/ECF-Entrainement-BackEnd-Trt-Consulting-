<?php

namespace App\Controller\Admin\Crud;

use App\Entity\Recruiter;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
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

    public function configureActions(Actions $actions): Actions
    {
        $details = Action::new('details', 'details')
            ->addCssClass('text-warning')
            ->linkToCrudAction(Crud::PAGE_DETAIL);


        return $actions
            ->setPermission(Action::DELETE, "ROLE_CONSULTANT")
            ->setPermission(Action::EDIT, "ROLE_CONSULTANT")
            ->add(Crud::PAGE_INDEX, $details);
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
            AssociationField::new('announce_id', 'Annonces'),
            CollectionField::new('publishValidations', 'Annonces validés'),

        ];
    }


}
