<?php

namespace App\Tests\Unit\Entity;

use App\Entity\Announce;
use App\Entity\Company;
use App\Entity\Recruiter;
use PHPUnit\Framework\TestCase;

class RecruiterTest extends TestCase
{
    public function testAddAndRemoveCompanyIsTrue(): void
    {
        $company = new Company();

        $recruiter = (new Recruiter())
            ->addCompanyId($company);

        $this->assertTrue((bool)$recruiter->getCompanyId());

        $recruiter->removeCompanyId($company);

        $this->assertEmpty($recruiter->getCompanyId());
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
