<?php

namespace App\EventSubscriber\EasyAdminSubscriber;


use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Event\AfterEntityUpdatedEvent;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;

class ValidNewUser implements EventSubscriberInterface
{
    private MailerInterface $mailer;

    public function __construct(
        MailerInterface $mailer,
    ) {
        $this->mailer = $mailer;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            AfterEntityUpdatedEvent::class => ['updateAnnounceApplicant'],
        ];
    }


    /**
     * @throws TransportExceptionInterface
     */
    public function updateAnnounceApplicant(AfterEntityUpdatedEvent $event): void
    {
        $entity = $event->getEntityInstance();
        $userEmail = $entity->getEmail();

        if ($entity->isIsValidated() === false) {
            $email = (new TemplatedEmail())
                ->from(new Address('d1133854c0-21dbeb@inbox.mailtrap.io', 'Trt Consulting'))
                ->to($userEmail)
                ->subject('Votre compte a été désactivé ! ')
                ->text('Pour plus de renseignements, merci de contacté notre équipe par mail.!')
                ->htmlTemplate('email/deactivate_user_account_email.html.twig');

        } else {
            $email = (new TemplatedEmail())
                ->from(new Address('d1133854c0-21dbeb@inbox.mailtrap.io', 'Trt Consulting'))
                ->to($userEmail)
                ->subject('Votre compte est actif ! ')
                ->text('Rendez vous sur votre page de connection pour profiter de nos services!')
                ->htmlTemplate('email/valid_user_account_email.html.twig');

        }
        $this->mailer->send($email);


        if (!($entity instanceof User)) {
            return;
        }

    }
}