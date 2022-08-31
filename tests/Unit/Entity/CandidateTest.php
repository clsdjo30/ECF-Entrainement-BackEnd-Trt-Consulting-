<?php

namespace App\Tests\Unit\Entity;

use App\Entity\ApplyValidation;
use App\Entity\Candidate;
use PHPUnit\Framework\TestCase;

class CandidateTest extends TestCase
{
    public function testCandidateIsTrue(): void
    {
        $candidate = (new Candidate())
            ->setFirstname('prenom')
            ->setLastname('nom de famille')
            ->setCvFile('Mon Super CV');
        $this->assertTrue((bool)$candidate->getCvFile('Mon Super CV'));
        $this->assertTrue((bool)$candidate->getFirstname('prenom'));
        $this->assertTrue((bool)$candidate->getLastname('nom de famille'));

    }

    public function testCandidateIsFalse(): void
    {
        $candidate = (new Candidate())
            ->setFirstname('prenom')
            ->setLastname('nom de famille')
            ->setCvFile('Mon Super CV');
        $this->assertNotSame('false', (bool)$candidate->getCvFile());
        $this->assertNotSame('false', (bool)$candidate->getFirstname());
        $this->assertNotSame('false', (bool)$candidate->getLastname());

    }

    public function testCandidateIsEmpty(): void
    {
        $candidate = new Candidate();

        $this->assertEmpty((bool)$candidate->getCvFile());
        $this->assertEmpty((bool)$candidate->getFirstname());
        $this->assertEmpty((bool)$candidate->getLastname());
    }

    public function testAddAndRemoveApplyAnnounceIsTrue(): void
    {
        $newApply = new ApplyValidation();
        $candidate = (new Candidate())
            ->addApplyValidation($newApply);

        $this->assertTrue((bool)$candidate->getApplyValidations());

        $candidate->removeApplyValidation($newApply);

        $this->assertCount(0, $candidate->getApplyValidations());
    }
}
