<?php

namespace App\Tests\Unit\Entity;

use App\Entity\Announce;
use App\Entity\Recruiter;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

class RecruiterTest extends TestCase
{

    public function testCandidateIsTrue(): void
    {
        $user = new User();
        $candidate = (new Recruiter())
            ->setCompanyName('Test Name')
            ->setAddress('adresse de test')
            ->setCity('Ville de test')
            ->setCountry('pays de test')
            ->setPostalCode(30000)
            ->setUserId($user);
        $this->assertTrue((bool)$candidate->getCompanyName('Test Name'));
        $this->assertTrue((bool)$candidate->getAddress('adresse de test'));
        $this->assertTrue((bool)$candidate->getCity('ville de test'));
        $this->assertTrue((bool)$candidate->getCountry('pays de test'));
        $this->assertTrue((bool)$candidate->getPostalCode(30000));
        $this->assertTrue((bool)$candidate->getUserId());
        

    }

    public function testAddAndRemoveAnnounceIsTrue(): void
    {
        $announce = new Announce();

        $recruiter = (new Recruiter())
            ->addAnnounceId($announce);

        $this->assertTrue((bool)$recruiter->getAnnounceId());

        $recruiter->removeAnnounceId($announce);

        $this->assertEmpty($recruiter->getAnnounceId());
    }


}
