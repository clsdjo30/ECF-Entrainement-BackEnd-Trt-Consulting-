<?php

namespace App\Controller\Admin\Crud;

use App\Entity\PublishValidation;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class PublishValidationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return PublishValidation::class;
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
