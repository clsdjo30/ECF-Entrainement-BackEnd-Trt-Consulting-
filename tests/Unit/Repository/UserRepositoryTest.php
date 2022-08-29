<?php

namespace App\Tests\Unit\Repository;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Persistence\ObjectRepository;
use PHPUnit\Framework\TestCase;

class UserRepositoryTest extends TestCase
{
    public function testSomething(): void
    {
        $user = new User();
        $user->setEmail('user@test.com')
            ->setPassword('password');


        $userRepository = $this->createMock(ObjectRepository::class);

        $userRepository->expects($this->any())
            ->method('findAll')
            ->willReturn($user);

        $objectManager = $this->createMock(ObjectManager::class);

        $objectManager->expects($this->any())
            ->method('getRepository')
            ->willReturn($userRepository);

        $newUser = new User($objectManager);
        $newUser->setEmail('user@test.com');
        $this->assertEquals('user@test.com', $newUser->getEmail());
    }
}
