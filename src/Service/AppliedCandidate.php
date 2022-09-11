<?php


namespace App\Service;


use App\Entity\Announce;
use App\Entity\ApplyValidation;
use App\Entity\Candidate;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AppliedCandidate extends AbstractController
{
    private EntityManagerInterface $manager;

    public function __construct(
        EntityManagerInterface $manager,
    ) {
        $this->manager = $manager;
    }

    public function addCandidateForValidation(
        Announce $announce,
        Candidate $candidate
    ): bool {

        $validation = (new ApplyValidation())->setCandidateIsValid(false);
        $candidate->addApplyValidation($validation);
        $announce->addAppliedCandidate($validation);


        $this->manager->persist($validation);

        $this->manager->flush();

        return true;

    }

}