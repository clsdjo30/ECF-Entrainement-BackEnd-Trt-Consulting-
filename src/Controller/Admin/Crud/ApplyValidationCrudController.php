<?php

namespace App\Controller\Admin\Crud;

use App\Entity\ApplyValidation;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ApplyValidationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ApplyValidation::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
