<?php

namespace App\Entity;

use App\Repository\ApplyValidationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ApplyValidationRepository::class)]
class ApplyValidation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'applyValidations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Candidate $candidate = null;

    #[ORM\ManyToOne(inversedBy: 'appliedCandidates')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Announce $announce = null;

    #[ORM\Column]
    private ?bool $candidateIsValid = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCandidate(): ?Candidate
    {
        return $this->candidate;
    }

    public function setCandidate(?Candidate $candidate): self
    {
        $this->candidate = $candidate;

        return $this;
    }

    public function getAnnounce(): ?Announce
    {
        return $this->announce;
    }

    public function setAnnounce(?Announce $announce): self
    {
        $this->announce = $announce;

        return $this;
    }

    public function isCandidateIsValid(): ?bool
    {
        return $this->candidateIsValid;
    }

    public function setCandidateIsValid(bool $candidateIsValid): self
    {
        $this->candidateIsValid = $candidateIsValid;

        return $this;
    }
}
