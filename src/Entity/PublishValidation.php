<?php

namespace App\Entity;

use App\Repository\PublishValidationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PublishValidationRepository::class)]
class PublishValidation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'publishValidations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Recruiter $recruiter = null;

    #[ORM\OneToOne(inversedBy: 'publishValidation', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Announce $announce = null;

    #[ORM\Column]
    private ?bool $announceIsValid = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRecruiter(): ?Recruiter
    {
        return $this->recruiter;
    }

    public function setRecruiter(?Recruiter $recruiter): self
    {
        $this->recruiter = $recruiter;

        return $this;
    }

    public function getAnnounce(): ?Announce
    {
        return $this->announce;
    }

    public function setAnnounce(Announce $announce): self
    {
        $this->announce = $announce;

        return $this;
    }

    public function isAnnounceIsValid(): ?bool
    {
        return $this->announceIsValid;
    }

    public function setAnnounceIsValid(bool $announceIsValid): self
    {
        $this->announceIsValid = $announceIsValid;

        return $this;
    }

}
