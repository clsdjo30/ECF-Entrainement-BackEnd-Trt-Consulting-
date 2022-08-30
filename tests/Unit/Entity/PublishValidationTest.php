<?php

namespace App\Tests\Unit\Entity;

use App\Entity\Announce;
use App\Entity\PublishValidation;
use App\Entity\Recruiter;
use PHPUnit\Framework\TestCase;

class PublishValidationTest extends TestCase
{
    public function testPublishValidationIsTrue(): void
    {
        $recruiter = new Recruiter();
        $announce = new Announce();
        $newPublish = (new PublishValidation())
            ->setRecruiter($recruiter)
            ->setAnnounce($announce)
            ->setAnnounceIsValid(true);

        $this->assertTrue((bool)$newPublish->getRecruiter());
        $this->assertTrue((bool)$newPublish->getAnnounce());
        $this->assertTrue((bool)$newPublish->isAnnounceIsValid());
    }
}
