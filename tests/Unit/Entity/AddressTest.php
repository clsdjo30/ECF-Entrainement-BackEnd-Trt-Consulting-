<?php

namespace App\Tests\Unit\Entity;

use App\Entity\Address;
use App\Entity\Company;
use Exception;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Validator\ConstraintViolation;

class AddressTest extends KernelTestCase
{
    public function testAddressIsTrue(): void
    {
        $company = new Company();
        $address = (new Address())
            ->setStreetNumber(10)
            ->setStreetType('rue')
            ->setStreetName('du test')
            ->setZipCode(34000)
            ->setCity('Montpellier')
            ->setCountry('France')
            ->setCompany($company);


        $this->assertTrue((bool)$address->getStreetNumber());
        $this->assertTrue((bool)$address->getStreetType());
        $this->assertTrue((bool)$address->getStreetName());
        $this->assertTrue((bool)$address->getZipCode());
        $this->assertTrue((bool)$address->getCity());
        $this->assertTrue((bool)$address->getCountry());
        $this->assertTrue((bool)$address->getCompany());

    }

    public function testAddressIsFalse(): void
    {
        $address = (new Address())
            ->setStreetNumber(10)
            ->setStreetType('rue')
            ->setStreetName('du test')
            ->setZipCode(34000)
            ->setCity('Montpellier')
            ->setCountry('France');


        $this->assertNotSame(15, $address->getStreetNumber());
        $this->assertNotSame('false', $address->getStreetType());
        $this->assertNotSame('false', $address->getStreetName());
        $this->assertNotSame(13000, $address->getZipCode());
        $this->assertNotSame('false', $address->getCity());
        $this->assertNotSame('false', $address->getCountry());

    }

    public function testAddressIsEmpty(): void
    {
        $address = new Address();

        $this->assertEmpty($address->getStreetNumber());
        $this->assertEmpty($address->getStreetType());
        $this->assertEmpty($address->getStreetName());
        $this->assertEmpty($address->getZipCode());
        $this->assertEmpty($address->getCity());
        $this->assertEmpty($address->getCountry());
        $this->assertEmpty($address->getCompany());
    }

    /**
     * @throws Exception
     */
    public function testInvalidStreetNumber(): void
    {
        $address = new Address();

        $this->assertHasErrors($this->getEntity()->setStreetNumber(-10), 1);

    }

    /**
     * @throws Exception
     */
    public function assertHasErrors(Address $address, int $number = 0): void
    {
        self::bootKernel();
        $errors = self::getContainer()->get('validator')->validate($address);
        $messages = [];
        /** @var ConstraintViolation $error */
        foreach ($errors as $error) {
            $messages[] = $error->getPropertyPath().' => '.$error->getMessage();
        }
        $this->assertCount($number, $errors, implode(', ', $messages));
    }

    public function getEntity(): Address
    {
        return (new Address())
            ->setStreetNumber(10)
            ->setStreetType('rue')
            ->setStreetName('du test')
            ->setZipCode(34000)
            ->setCity('Montpellier')
            ->setCountry('France');
    }

    /**
     * @throws Exception
     */
    public function testInvalidStreetName(): void
    {
        $address = new Address();

        $this->assertHasErrors($this->getEntity()->setStreetName('de'), 1);

    }

    /**
     * @throws Exception
     */
    public function testInvalidZipCode(): void
    {

        $this->assertHasErrors($this->getEntity()->setZipCode(3400), 1);
        $this->assertHasErrors($this->getEntity()->setZipCode(-34000), 1);


    }

    /**
     * @throws Exception
     */
    public function testBlankZipCode(): void
    {

        $this->assertHasErrors($this->getEntity()->setZipCode(0), 1);

    }

    /**
     * @throws Exception
     */
    public function testInvalidBlankCountry(): void
    {

        $this->assertHasErrors($this->getEntity()->setCountry(''), 1);

    }

    /**
     * @throws Exception
     */
    public function testInvalidBlankCity(): void
    {

        $this->assertHasErrors($this->getEntity()->setCity(''), 1);

    }

    /**
     * @throws Exception
     */
    public function testInvalidBlankStreetType(): void
    {

        $this->assertHasErrors($this->getEntity()->setStreetType(''), 1);

    }
}
