<?php

namespace App\Controller\Admin\Crud;

use App\Entity\Consultant;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ConsultantCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Consultant::class;
    }


    public function configureFields(string $pageName): iterable
    {

        yield IdField::new('id')->hideOnIndex();
        yield AssociationField::new('user');
        yield TextField::new('firstname', 'Prénom');
        yield TextField::new('lastname', 'Nom de famille');

    }

}
