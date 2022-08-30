<?php

namespace App\Tests\Unit\Entity;

use App\Entity\Announce;
use App\Entity\ApplyValidation;
use App\Entity\PublishValidation;
use App\Entity\Recruiter;
use DateTime;
use PHPUnit\Framework\TestCase;

class AnnounceTest extends TestCase
{
    public function testAnnounceIsTrue(): void
    {
        $recruiter = new Recruiter();

        $announce = (new Announce())
            ->setTitle('annonce de test')
            ->setDescription('description de test')
            ->setSalary(2500)
            ->setHourly('39 heures')
            ->setBenefits('logé')
            ->setExperience('5 ans minimum')
            ->setSlug('annonce-de-test')
            ->setIsValid(true)
            ->setCreatedAt(new DateTime())
            ->setUpdatedAt(new DateTime)
            ->setRecruiter($recruiter);

        $this->assertTrue((bool)$announce->getTitle());
        $this->assertTrue((bool)$announce->getDescription());
        $this->assertTrue((bool)$announce->getSalary());
        $this->assertTrue((bool)$announce->getHourly());
        $this->assertTrue((bool)$announce->getBenefits());
        $this->assertTrue((bool)$announce->getExperience());
        $this->assertTrue((bool)$announce->getSlug());
        $this->assertTrue((bool)$announce->isIsValid());
        $this->assertTrue((bool)$announce->getCreatedAt());
        $this->assertTrue((bool)$announce->getUpdatedAt());
        $this->assertTrue((bool)$announce->getRecruiter());

    }

    public function testAnnounceIsFalse(): void
    {
        $announce = (new Announce())
            ->setTitle('annonce de test')
            ->setDescription('description de test')
            ->setSalary(2500)
            ->setHourly('39 heures')
            ->setBenefits('logé')
            ->setExperience('5 ans minimum')
            ->setSlug('annonce-de-test')
            ->setIsValid(true)
            ->setCreatedAt(new DateTime())
            ->setUpdatedAt(new DateTime());

        $this->assertNotSame('false', (bool)$announce->getTitle());
        $this->assertNotSame('false', (bool)$announce->getDescription());
        $this->assertNotSame(1000, (bool)$announce->getSalary());
        $this->assertNotSame('false', (bool)$announce->getHourly());
        $this->assertNotSame('false', (bool)$announce->getBenefits());
        $this->assertNotSame('false', (bool)$announce->getExperience());
        $this->assertNotSame('false', (bool)$announce->getSlug());
        $this->assertNotSame(new DateTime(), (bool)$announce->getCreatedAt());
        $this->assertNotSame(new DateTime(), (bool)$announce->getUpdatedAt());

    }

    public function testAnnounceIsEmpty(): void
    {
        $announce = new Announce();

        $this->assertEmpty($announce->getTitle());
        $this->assertEmpty($announce->getDescription());
        $this->assertEmpty($announce->getSalary());
        $this->assertEmpty($announce->getHourly());
        $this->assertEmpty($announce->getBenefits());
        $this->assertEmpty($announce->getExperience());
        $this->assertEmpty($announce->getSlug());
        $this->assertEmpty($announce->getCreatedAt());
        $this->assertEmpty($announce->getUpdatedAt());
    }

    public function testAddAndRemoveApplyAnnounceIsTrue(): void
    {
        $newApply = new ApplyValidation();
        $announce = (new Announce())
            ->addAppliedCandidate($newApply);

        $this->assertTrue((bool)$announce->getAppliedCandidates());

        $announce->removeAppliedCandidate($newApply);

        $this->assertCount(0, $announce->getAppliedCandidates());
    }

    public function testAnnounceIsValidateIsTrue(): void
    {
        $validation = new PublishValidation();
        $announce = (new Announce())
            ->setPublishValidation($validation);

        $this->assertTrue((bool)$announce->getPublishValidation());
    }
}
