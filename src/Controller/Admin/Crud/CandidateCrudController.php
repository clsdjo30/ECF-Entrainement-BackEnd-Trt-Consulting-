<?php

namespace App\Controller\Admin\Crud;

use App\Entity\Candidate;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CandidateCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Candidate::class;
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
            ->setEntityLabelInPlural('Candidats')
            ->setEntityLabelInSingular('Candidat')
            ->setPageTitle('index', 'Tous les %entity_label_plural%')
            ->setPageTitle('edit', 'Compléter mon profil')
            ->setPaginatorPageSize(15)
            ->setDateFormat('dd:MM:yyyy')
            ->showEntityActionsInlined()
            ->setDefaultSort(['id' => 'desc']);
    }

    public function configureFields(string $pageName): iterable
    {

        yield IdField::new('id')->hideOnIndex()->onlyOnForms();
        yield AssociationField::new('user', 'Utilisateur');
        yield TextField::new('firstname', 'Prénom');
        yield TextField::new('lastname', 'Nom de famille');
        yield TextField::new('cvFile', 'Curriculum Vitae');
        yield CollectionField::new('applyValidations', 'Candidature approuvée');


    }

    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        $this->updateEntity($entityManager, $entityInstance);

        $this->addFlash('success', 'Votre Candidat à bien été modifier .');
    }


}
