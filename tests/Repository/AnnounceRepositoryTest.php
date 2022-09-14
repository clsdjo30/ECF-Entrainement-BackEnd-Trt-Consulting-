<?php

namespace App\Tests\Repository;

use App\Repository\AnnounceRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class AnnounceRepositoryTest extends KernelTestCase
{


    /**
     * @throws \Exception
     */
    public function testCountAnnounce()
    {
        self::bootKernel();

        $announce = self::getContainer()->get(AnnounceRepository::class)->count([]);

        $this->assertEquals(30, $announce);
    }

    /**
     * @throws \Exception
     */
    public function testAnnounceIsValid(): void
    {
        self::bootKernel();;
        $announces = self::getContainer()->get(AnnounceRepository::class)->findBy(['isValid' => true]);
        $validAnnounce = count($announces);

        $this->assertEquals(18, $validAnnounce);
    }

}