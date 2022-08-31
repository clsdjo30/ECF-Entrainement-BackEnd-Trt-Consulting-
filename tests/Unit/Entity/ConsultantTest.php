<?php

namespace App\Tests\Unit\Entity;

use App\Entity\Consultant;
use PHPUnit\Framework\TestCase;

class ConsultantTest extends TestCase
{
    public function testCandidateIsTrue(): void
    {
        $candidate = (new Consultant())
            ->setFirstname('prenom')
            ->setLastname('nom de famille');

        $this->assertTrue((bool)$candidate->getFirstname('prenom'));
        $this->assertTrue((bool)$candidate->getLastname('nom de famille'));

    }

    public function testCandidateIsFalse(): void
    {
        $candidate = (new Consultant())
            ->setFirstname('prenom')
            ->setLastname('nom de famille');

        $this->assertNotSame('false', (bool)$candidate->getFirstname());
        $this->assertNotSame('false', (bool)$candidate->getLastname());

    }

    public function testCandidateIsEmpty(): void
    {
        $candidate = new Consultant();

        $this->assertEmpty((bool)$candidate->getFirstname());
        $this->assertEmpty((bool)$candidate->getLastname());
    }
}
