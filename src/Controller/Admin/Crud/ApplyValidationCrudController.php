<?php

namespace App\Controller\Admin\Crud;

use App\Entity\ApplyValidation;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;

class ApplyValidationCrudController extends AbstractCrudController
{
    private MailerInterface $mailer;

    public function __construct(
        MailerInterface $mailer,
    ) {
        $this->mailer = $mailer;
    }

    public static function getEntityFqcn(): string
    {
        return ApplyValidation::class;
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
            ->setEntityLabelInPlural('Validations de Candidatures')
            ->setEntityLabelInSingular('Validation de Candidature')
            ->setPageTitle('index', 'Toutes les %entity_label_plural%')
            ->setPaginatorPageSize(10)
            ->setDateFormat('dd:MM:yyyy')
            ->showEntityActionsInlined()
            ->setDefaultSort(['id' => 'desc']);
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnIndex()->onlyOnForms()->hideWhenUpdating(),
            AssociationField::new('candidate', 'Candidat'),
            AssociationField::new('announce', 'Annonce'),
            BooleanField::new('candidateIsValid', 'Validé'),

        ];
    }

    /**
     * @param EntityManagerInterface $entityManager
     * @param $entityInstance
     * @return void
     * @throws TransportExceptionInterface
     */
    public function updateEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        parent::updateEntity($entityManager, $entityInstance);

        $recruiter = $entityInstance->getAnnounce()->getRecruiter()->getUserId()->getEmail();
       
        $candidateFullName = $entityInstance->getCandidate()->fullName();
        $candidateCv = $entityInstance->getCandidate()->getCvFile();


        if ($entityInstance->isCandidateIsValid()) {

            $email = (new TemplatedEmail())
                ->from(new Address('contact@c-and-com.studio', 'Trt Consulting'))
                ->to($recruiter)
                ->subject('Vous avez reçu une candidature!')
                ->context([
                    'candidate' => $candidateFullName,
                ])
                ->text('Pour plus de renseignements, merci de contacté notre équipe par mail.!')
                ->htmlTemplate('email/applied_candidate_email.html.twig')
                ->attachFromPath(
                    new File(
                        $this->getParameter('cvs_directory').'/'.$candidateCv
                    )
                );

            $this->addFlash('success', "Un Email avec les information du candidat vient d'être envoyé au recruteur !");

            $this->mailer->send($email);
        }
    }


}
