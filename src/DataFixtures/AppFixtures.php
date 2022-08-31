<?php

namespace App\DataFixtures;

use App\Factory\CandidateFactory;
use App\Factory\ConsultantFactory;
use App\Factory\RecruiterFactory;
use App\Factory\UserFactory;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Création des Utilisateurs de test
        UserFactory::createOne([
            'email' => 'admin@trt-consulting.com',
            'roles' => ['ROLE_ADMIN'],
            'createdAt' => new DateTime(),
            'updatedAt' => new DateTime(),
            'isValidated' => true,
        ]);

        $consultant = UserFactory::createOne([
            'email' => 'consultant@trt-consulting.com',
            'roles' => ['ROLE_CONSULTANT'],
            'createdAt' => new DateTime(),
            'updatedAt' => new DateTime(),
            'isValidated' => true,
        ]);
        ConsultantFactory::createOne([
            'user' => $consultant,
        ]);
        $candidate = UserFactory::createOne([
            'email' => 'candidat@trt-consulting.com',
            'roles' => ['ROLE_CANDIDATE'],
            'createdAt' => new DateTime(),
            'updatedAt' => new DateTime(),
            'isValidated' => true,
        ]);
        CandidateFactory::createOne([
            'user' => $candidate,
            'firstname' => 'cedric',
            'lastname' => 'le sergent',
            'cvFile' => 'mon Super CV',
        ]);
        $recruiter = UserFactory::createOne([
            'email' => 'recruiter@trt-consulting.com',
            'roles' => ['ROLE_RECRUITER'],
            'createdAt' => new DateTime(),
            'updatedAt' => new DateTime(),
            'isValidated' => true,
        ]);
        RecruiterFactory::createOne([
            'user_id' => $recruiter,
        ]);


        // Création de 5 CONSULTANT
        for ($i = 0; $i < 5; $i++) {
            $user = UserFactory::createOne([
                'roles' => ['ROLE_CONSULTANT'],
                'createdAt' => new DateTime(),
                'updatedAt' => new DateTime(),
                'isValidated' => true,

            ]);
            ConsultantFactory::createOne([
                'user' => $user,
            ]);
        }

    }
}
