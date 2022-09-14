<?php

namespace App\Tests\Repository;

use App\Repository\UserRepository;
use Exception;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UserRepositoryTest extends KernelTestCase
{
    /**
     * @throws Exception
     */
    public function testSomething(): void
    {

        self::bootKernel();

        $users = self::getContainer()->get(UserRepository::class)->count([]);

        $this->assertEquals(57, $users);

    }
}
