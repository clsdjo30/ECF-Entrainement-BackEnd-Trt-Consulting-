<?php

namespace App\Entity;

use App\Repository\CandidateRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CandidateRepository::class)]
class Candidate
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $firstname = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $lastname = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $cvFile = null;

    #[ORM\OneToMany(mappedBy: 'candidate', targetEntity: ApplyValidation::class, orphanRemoval: true)]
    private Collection $applyValidations;

    public function __construct()
    {
        $this->applyValidations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(?string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(?string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getCvFile(): ?string
    {
        return $this->cvFile;
    }

    public function setCvFile(?string $cvFile): self
    {
        $this->cvFile = $cvFile;

        return $this;
    }

    /**
     * @return Collection<int, ApplyValidation>
     */
    public function getApplyValidations(): Collection
    {
        return $this->applyValidations;
    }

    public function addApplyValidation(ApplyValidation $applyValidation): self
    {
        if (!$this->applyValidations->contains($applyValidation)) {
            $this->applyValidations->add($applyValidation);
            $applyValidation->setCandidate($this);
        }

        return $this;
    }

    public function removeApplyValidation(ApplyValidation $applyValidation): self
    {
        if ($this->applyValidations->removeElement($applyValidation)) {
            // set the owning side to null (unless already changed)
            if ($applyValidation->getCandidate() === $this) {
                $applyValidation->setCandidate(null);
            }
        }

        return $this;
    }
}
