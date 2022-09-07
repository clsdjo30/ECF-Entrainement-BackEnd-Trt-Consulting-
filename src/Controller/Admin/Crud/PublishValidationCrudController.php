<?php

namespace App\Controller\Admin\Crud;

use App\Entity\PublishValidation;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;


class PublishValidationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return PublishValidation::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Validations de Announces')
            ->setEntityLabelInSingular('Validation de Announce')
            ->setPageTitle('index', 'Toutes les %entity_label_plural%')
            ->setPaginatorPageSize(10)
            ->setDateFormat('dd:MM:yyyy')
            ->showEntityActionsInlined()
            ->setDefaultSort(['id' => 'asc']);
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

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnIndex()->onlyOnForms()->hideWhenUpdating(),
            AssociationField::new('recruiter', 'Recruiter'),
            AssociationField::new('announce', 'Annonce'),
            BooleanField::new('announceIsValid', 'Validé'),

        ];
    }

    public function configureAssets(Assets $assets): Assets
    {
        return parent::configureAssets($assets)
            ->addWebpackEncoreEntry('admin');
    }


}
