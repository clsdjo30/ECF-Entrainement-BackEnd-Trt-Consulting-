<?php

namespace App\Tests\Unit\Entity;

use App\Entity\Company;
use PHPUnit\Framework\TestCase;

class CompanyTest extends TestCase
{
    public function testCandidateIsTrue(): void
    {
        $candidate = (new Company())
            ->setName('Entreprise test');
        $this->assertTrue((bool)$candidate->getName('Entreprise Test'));

    }

    public function testCandidateIsFalse(): void
    {
        $candidate = (new Company())
            ->setName('Entreprise Test');
        $this->assertNotSame('false Entreprise Test', (bool)$candidate->getName());

    }

    public function testCandidateIsEmpty(): void
    {
        $candidate = new Company();

        $this->assertEmpty((bool)$candidate->getName());
    }
}
