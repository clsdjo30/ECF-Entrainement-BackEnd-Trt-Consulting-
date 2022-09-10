<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Factory\AnnounceFactory;
use App\Factory\ApplyValidationFactory;
use App\Factory\CandidateFactory;
use App\Factory\RecruiterFactory;
use App\Factory\UserFactory;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Exception;


class CategoriesAndAnnounceFixtures extends Fixture
{
    private int $counter = 1;


    /**
     * @throws Exception
     */
    public function load(ObjectManager $manager): void
    {
        $parent = $this->createCategory('Cuisine', null, $manager);

        $this->createCategory('Chef de cuisine', $parent, $manager);
        $this->createCategory('Seconde cuisine', $parent, $manager);
        $this->createCategory('Chef de partie', $parent, $manager);

        $parent = $this->createCategory('Salle', null, $manager);

        $this->createCategory('Directeur de restaurant', $parent, $manager);
        $this->createCategory('Responsable de salle', $parent, $manager);
        $this->createCategory('Chef de rang', $parent, $manager);

        $manager->flush();

        // Tableau d'annonces validées
        $validAnnounces = [];

        // Création de 10 Recruteurs qui créent chacun 2 annonces
        for ($i = 0; $i < 30; $i++) {
            //1 user avec le role recruiter
            $recruiter = UserFactory::createOne([
                'roles' => ['ROLE_RECRUITER'],
                'createdAt' => new DateTime(),
                'updatedAt' => new DateTime(),
                'isValidated' => true,
                'isVerified' => true,
                'recruiter' => RecruiterFactory::createOne(),
            ]);


            $category = $this->getReference('cat-'.random_int(1, 8));
            $announce = AnnounceFactory::createOne(
                [
                    'recruiter' => $recruiter->getRecruiter(),
                    'category' => $category,
                ]
            );


            if ($announce->isIsValid() === true) {
                $validAnnounces[] = $announce;
            }

        }


        foreach ($validAnnounces as $validAnnounce) {
            $user = UserFactory::createOne([
                'roles' => ['ROLE_CANDIDATE'],
                'createdAt' => new DateTime(),
                'updatedAt' => new DateTime(),
                'isValidated' => true,
                'isVerified' => true,
            ]);

            $candidate = CandidateFactory::createOne([
                'user' => $user,
            ]);

            ApplyValidationFactory::createOne([
                'candidate' => $candidate,
                'announce' => $validAnnounce,
            ]);
        }
    }

    public function createCategory(string $name, Category $parent = null, ObjectManager $manager): Category
    {
        $category = new Category();
        $category->setName($name);
        $category->setParent($parent);
        $manager->persist($category);

        $this->addReference('cat-'.$this->counter, $category);
        $this->counter++;

        return $category;
    }

}