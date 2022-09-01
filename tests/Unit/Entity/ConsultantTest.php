<?php

namespace App\Tests\Unit\Entity;

use App\Entity\Consultant;
use App\Entity\User;
use Exception;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Validator\ConstraintViolation;

class ConsultantTest extends KernelTestCase
{

    public function testConsultantIsTrue(): void
    {
        $consultant = (new Consultant())
            ->setFirstname('prenom')
            ->setLastname('nom de famille');

        $this->assertTrue((bool)$consultant->getFirstname('prenom'));
        $this->assertTrue((bool)$consultant->getLastname('nom de famille'));

    }

    public function testConsultantIsFalse(): void
    {
        $consultant = (new Consultant())
            ->setFirstname('prenom')
            ->setLastname('nom de famille');

        $this->assertNotSame('false', (bool)$consultant->getFirstname());
        $this->assertNotSame('false', (bool)$consultant->getLastname());

    }

    public function testConsultantIsEmpty(): void
    {
        $consultant = new Consultant();

        $this->assertEmpty((bool)$consultant->getFirstname());
        $this->assertEmpty((bool)$consultant->getLastname());
    }

    /**
     * @throws Exception
     */
    public function testInvalidBlankFirstnameEntity(): void
    {
        $this->assertHasErrors($this->getEntity()->setFirstname(''), 1);
    }

    /**
     * @throws Exception
     */
    public function assertHasErrors(Consultant $consultant, int $number = 0): void
    {
        self::bootKernel();
        $errors = self::getContainer()->get('validator')->validate($consultant);
        $messages = [];
        /** @var ConstraintViolation $error */
        foreach ($errors as $error) {
            $messages[] = $error->getPropertyPath().' => '.$error->getMessage();
        }
        $this->assertCount($number, $errors, implode(', ', $messages));
    }

    public function getEntity(): Consultant
    {
        return (new Consultant())
            ->setFirstname('Laurent')
            ->setLastname('Dupont');
    }

    /**
     * @throws Exception
     */
    public function testInvalidBlankLastnameEntity(): void
    {
        $this->assertHasErrors($this->getEntity()->setLastname(''), 1);
    }

    public function testValidConsultantGetUserEntity(): void
    {
        $user = new User();
        $consultant = (new Consultant())->setUser($user);

        $this->assertTrue((bool)$consultant->getUser());
    }

    /**
     * @throws Exception
     */
    public function testValidConsultantEntity(): void
    {
        $this->assertHasErrors($this->getEntity(), 0);
    }

    /**
     * @throws Exception
     */
    public function testInvalidConsultantEntity(): void
    {
        $this->assertHasErrors($this->getEntity()->setFirstname('BonjourVotreNomEstCarementTropLong'), 1);
        $this->assertHasErrors($this->getEntity()->setFirstname('BonjourVotreNomEstCarementTropLong'), 1);
    }
}
