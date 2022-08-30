<?php

namespace App\Tests\Unit\Entity;

use App\Entity\Announce;
use App\Entity\ApplyValidation;
use App\Entity\Candidate;
use PHPUnit\Framework\TestCase;

class ApplyValidationTest extends TestCase
{
    public function testCreateApplyIsTrue(): void
    {
        $candidate = new Candidate();
        $announce = new Announce();
        $newApply = (new ApplyValidation())
            ->setCandidate($candidate)
            ->setAnnounce($announce)
            ->setCandidateIsValid(true);

        $this->assertTrue((bool)$newApply->getCandidate());
        $this->assertTrue((bool)$newApply->getAnnounce());
        $this->assertTrue((bool)$newApply->isCandidateIsValid());
    }
}
