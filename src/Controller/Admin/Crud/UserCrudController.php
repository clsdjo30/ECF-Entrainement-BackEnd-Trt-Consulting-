<?php

namespace App\Controller\Admin\Crud;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;

class UserCrudController extends AbstractCrudController
{
    private MailerInterface $mailer;

    public function __construct(
        MailerInterface $mailer,
    ) {
        $this->mailer = $mailer;
    }

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
        yield IdField::new('id')->hideOnIndex()->hideOnForm();
        yield EmailField::new('email');
        yield TextField::new('password', 'Mot de Passe')->hideOnForm()->hideOnIndex()->hideOnDetail();
        yield ArrayField::new('roles', 'Roles');
        yield BooleanField::new('isVerified', 'Vérifié')->renderAsSwitch(false);
        yield BooleanField::new('isValidated', 'Validé')->renderAsSwitch(false);
        yield AssociationField::new('recruiter', 'Recruteur')->hideOnIndex();
        yield AssociationField::new('candidate', 'Candidats')->hideOnIndex()->hideOnForm();
    }

    /**
     * @param EntityManagerInterface $entityManager
     * @param $entityInstance
     * @return void
     * @throws TransportExceptionInterface
     */
    public function updateEntity(
        EntityManagerInterface $entityManager,
        $entityInstance
    ): void {
        parent::updateEntity($entityManager, $entityInstance);
        $userEmail = $entityInstance->getEmail();

        if ($entityInstance->isIsValidated() === false) {
            $email = (new TemplatedEmail())
                ->from(new Address('contact@c-and-com.studio', 'Trt Consulting'))
                ->to($userEmail)
                ->subject('Votre compte a été désactivé ! ')
                ->text('Pour plus de renseignements, merci de contacté notre équipe par mail.!')
                ->htmlTemplate('email/deactivate_user_account_email.html.twig');

        } else {
            $email = (new TemplatedEmail())
                ->from(new Address('contact@c-and-com.studio', 'Trt Consulting'))
                ->to($userEmail)
                ->subject('Votre compte est actif ! ')
                ->text('Rendez vous sur votre page de connection pour profiter de nos services!')
                ->htmlTemplate('email/valid_user_account_email.html.twig');

        }
        $this->mailer->send($email);
        if ($entityInstance->isIsValidated()) {
            $this->addFlash('success', "Vous venez d'activer un nouveau membre ! ");
        } else {
            $this->addFlash('warning', "Vous venez de désactiver un membre ! ");
        }
    }


}
