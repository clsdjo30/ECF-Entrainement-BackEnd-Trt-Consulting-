<?php

namespace App\DataFixtures;


use App\Entity\Candidate;
use App\Entity\Consultant;
use App\Entity\User;
use App\Factory\ConsultantFactory;
use App\Factory\UserFactory;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

/**
 * @codeCoverageIgnore
 */
class AppFixtures extends Fixture
{
    /**
     * Encodeur de mot de passe
     *
     * @var UserPasswordHasherInterface
     */
    private UserPasswordHasherInterface $encoder;

    public function __construct(
        UserPasswordHasherInterface $encoder,

    ) {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager): void
    {


        // Création des Utilisateurs de test
        // Administrateur
        $admin = (new User());
        $admin->setEmail('admin@trt-consulting.com');
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setPassword($this->encoder->hashPassword($admin, 'password'));

        //Consultant

        $userConsultant = new User();
        $userConsultant->setEmail('consultant@trt-consulting.com');
        $userConsultant->setRoles(['ROLE_CONSULTANT']);
        $userConsultant->setPassword($this->encoder->hashPassword($userConsultant, 'password'));
        $userConsultant->setIsVerified(true);
        $userConsultant->setIsValidated(true);

        $consultant = (new Consultant())
            ->setUser($userConsultant);

        // Candidate
        $userCandidate = new User();
        $userCandidate->setEmail('candidate@trt-consulting.com');
        $userCandidate->setRoles(['ROLE_CANDIDATE']);
        $userCandidate->setPassword($this->encoder->hashPassword($userCandidate, 'password'));
        $userCandidate->setIsVerified(true);
        $userCandidate->setIsValidated(true);

        $candidate = (new Candidate())
            ->setUser($userCandidate);

        // Recruiter

        $userRecruiter = new User();
        $userRecruiter->setEmail('recruiter@trt-consulting.com');
        $userRecruiter->setRoles(['ROLE_RECRUITER']);
        $userRecruiter->setPassword($this->encoder->hashPassword($userRecruiter, 'password'));
        $userRecruiter->setIsVerified(true);
        $userRecruiter->setIsValidated(true);

        $recruiter = (new Candidate())
            ->setUser($userRecruiter);


        // Création de 5 CONSULTANT
        for ($i = 0; $i < 5; $i++) {
            $user = UserFactory::createOne([
                'roles' => ['ROLE_CONSULTANT'],
                'createdAt' => new DateTime(),
                'updatedAt' => new DateTime(),
                'isValidated' => true,
                'isVerified' => true,

            ]);
            ConsultantFactory::createOne([
                'user' => $user,
            ]);


            $manager->persist($admin);
            $manager->persist($consultant);
            $manager->persist($candidate);
            $manager->persist($recruiter);

            $manager->flush();
        }

    }
}
