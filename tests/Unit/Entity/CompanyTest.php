<?php

namespace App\Tests\Unit\Entity;

use App\Entity\Address;
use App\Entity\Company;
use App\Entity\Recruiter;
use PHPUnit\Framework\TestCase;

class CompanyTest extends TestCase
{
    public function testCandidateIsTrue(): void
    {
        $recruiter = new Recruiter();
        $address = new Address();
        $company = (new Company())
            ->setName('Entreprise test')
            ->setAddressId($address)
            ->setRecruiter($recruiter);

        $this->assertTrue((bool)$company->getName());
        $this->assertTrue((bool)$company->getAddressId());
        $this->assertTrue((bool)$company->getRecruiter());

    }

    public function testCandidateIsFalse(): void
    {
        $company = (new Company())
            ->setName('Entreprise Test');

        $this->assertNotSame('false Entreprise Test', (bool)$company->getName());

    }

    public function testCandidateIsEmpty(): void
    {
        $company = new Company();

        $this->assertEmpty((bool)$company->getName());
    }
}
