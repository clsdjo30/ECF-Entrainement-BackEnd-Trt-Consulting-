<?php

namespace App\Tests\Unit\Entity;

use App\Entity\Announce;
use App\Entity\Company;
use App\Entity\PublishValidation;
use App\Entity\Recruiter;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

class RecruiterTest extends TestCase
{
    public function testAddAndRemoveCompanyIsTrue(): void
    {
        $company = new Company();

        $user = new User();

        $recruiter = (new Recruiter())
            ->addCompanyId($company);

        $this->assertTrue((bool)$recruiter->getCompanyId());

        $recruiter->removeCompanyId($company);

        $this->assertEmpty($recruiter->getCompanyId());

        $recruiter->setUserId($user);

        $this->assertSame($recruiter->getUserId(), $user);
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

    public function testAnnouncePublishValidationIsTrue(): void
    {
        $newPublish = new PublishValidation();
        $recruiter = (new Recruiter())
            ->addPublishValidation($newPublish);

        $this->assertTrue((bool)$recruiter->getPublishValidations());

        $recruiter->removePublishValidation($newPublish);

        $this->assertCount(0, $recruiter->getPublishValidations());


    }

}
