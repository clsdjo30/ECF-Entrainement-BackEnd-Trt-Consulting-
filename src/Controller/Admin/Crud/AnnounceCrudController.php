<?php

namespace App\Controller\Admin\Crud;

use App\Entity\Announce;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;

class AnnounceCrudController extends AbstractCrudController
{
    private MailerInterface $mailer;

    public function __construct(
        MailerInterface $mailer,
    ) {
        $this->mailer = $mailer;
    }

    public static function getEntityFqcn(): string
    {
        return Announce::class;
    }

    /**
     * @param string $pageName
     * @return iterable
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnDetail()->hideOnForm()->hideOnIndex(),
            TextField::new('title', 'Titre'),
            AssociationField::new('category', 'Categories'),
            TextareaField::new('description', 'Description'),
            TextField::new('experience', 'Experience'),
            IntegerField::new('salary', 'Salaire'),
            TextField::new('hourly', 'Horaire'),
            TextField::new('slug', 'Slug'),
            BooleanField::new('isValid', 'Validé')->renderAsSwitch(false),


        ];

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

        $recruiterEmail = $entityInstance->getRecruiter()->getUserId()->getEmail();

        if ($entityInstance->isIsValid()) {

            $email = (new TemplatedEmail())
                ->from(new Address('contact@c-and-com.studio', 'Trt Consulting'))
                ->to($recruiterEmail)
                ->subject('Votre annonce est approuvée !')
                ->text('Pour plus de renseignements, merci de contacté notre équipe par mail.!')
                ->htmlTemplate('email/publish_confirmation_email.html.twig');

            $this->addFlash('success', "Vous venez d'envoyer un mail de validation au recruteur ");

            $this->mailer->send($email);
        }
    }


}
