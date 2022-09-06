<?php

namespace App\Controller\Admin\Crud;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Utilisateurs')
            ->setEntityLabelInSingular('Utilisateur')
            ->setPageTitle('index', 'Toutes les %entity_label_plural%')
            ->setPageTitle('new', 'Ajouter un nouvel %entity_label_singular%')
            ->setPaginatorPageSize(15)
            ->setDateFormat('dd:MM:yyyy')
            ->showEntityActionsInlined()
            ->setDefaultSort(['id' => 'desc'])
            ->showEntityActionsInlined();
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')->hideOnIndex()->hideOnForm();
        yield EmailField::new('email');
        yield TextField::new('password');
        yield BooleanField::new('isVerified');
        yield BooleanField::new('isValidated');
        yield AssociationField::new('recruiter');
        yield AssociationField::new('candidate');
    }


}
