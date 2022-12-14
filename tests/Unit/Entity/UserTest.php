<?php

namespace App\Tests\Unit\Entity;

use App\Entity\Recruiter;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testIsTrue(): void
    {

        $user = new User();

        $user->setEmail('true@email.com')
            ->setPassword('truepassword')
            ->setRoles(['ROLE_TEST']);

        $identifier = $user->getEmail();

        $this->assertSame($user->getUserIdentifier(), $identifier);
        $this->assertSame($user->getEmail(), 'true@email.com');
        $this->assertSame($user->getPassword(), 'truepassword');
        $this->assertSame($user->getRoles(), ['ROLE_TEST', 'ROLE_USER']);


    }

    public function testIsFalse(): void
    {
        $user = (new User())
            ->setEmail('true@email.com')
            ->setPassword('truepassword')
            ->setRoles(['ROLE_TEST']);

        $this->assertNotSame('false@email.com', $user->getEmail());
        $this->assertNotSame('falsepassword', $user->getPassword());
        $this->assertNotSame(['ROLE_USER'], $user->getRoles());

    }

    public function testRecruiterCreate(): void
    {
        $recruiter = new Recruiter();
        $user = (new User())
            ->setRecruiter($recruiter);

        $this->assertTrue((bool)$user->getRecruiter());

    }

    public function testUserIsValidIsTrue(): void
    {
        $user = (new User())->setIsValidated(true);

        $this->assertTrue($user->isIsValidated());
    }

    public function testUserIsVerifiedTrue(): void
    {
        $user = (new User())->setIsVerified(true);

        $this->assertTrue($user->isVerified());
    }
}
