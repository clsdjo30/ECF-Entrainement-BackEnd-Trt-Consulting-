<?php

namespace App\Tests\Unit\Entity;

use App\Entity\Address;
use App\Entity\Company;
use PHPUnit\Framework\TestCase;

class AddressTest extends TestCase
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
}
