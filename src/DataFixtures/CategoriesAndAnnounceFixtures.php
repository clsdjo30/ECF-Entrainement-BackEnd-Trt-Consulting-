<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Factory\AnnounceFactory;
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

        // Création de 10 Recruteurs qui créent chacun 2 annonces
        for ($i = 0; $i < 10; $i++) {
            //1 user avec le role recruiter
            $user = UserFactory::createOne([
                'roles' => ['ROLE_RECRUITER'],
                'createdAt' => new DateTime(),
                'updatedAt' => new DateTime(),
                'isValidated' => true,
            ]);

            $recruiter = RecruiterFactory::createOne([
                'userid' => $user,
            ]);

            for ($k = 0; $k < 2; $k++) {

                $category = $this->getReference('cat-'.random_int(1, 8));
                AnnounceFactory::createOne(
                    [
                        'recruiter' => $recruiter,
                        'category' => $category,

                    ]
                );
            }

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