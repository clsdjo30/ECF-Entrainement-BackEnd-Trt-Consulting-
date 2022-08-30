<?php

namespace App\Entity;

use App\Repository\RecruiterRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RecruiterRepository::class)]
class Recruiter
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToMany(mappedBy: 'recruiter', targetEntity: Company::class, orphanRemoval: true)]
    private Collection $company_id;

    #[ORM\OneToOne(inversedBy: 'recruiter', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user_id = null;

    #[ORM\OneToMany(mappedBy: 'recruiter', targetEntity: Announce::class, orphanRemoval: true)]
    private Collection $announce_id;

    #[ORM\OneToMany(mappedBy: 'recruiter', targetEntity: PublishValidation::class, orphanRemoval: true)]
    private Collection $publishValidations;

    public function __construct()
    {
        $this->company_id = new ArrayCollection();
        $this->announce_id = new ArrayCollection();
        $this->publishValidations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Company>
     */
    public function getCompanyId(): Collection
    {
        return $this->company_id;
    }

    public function addCompanyId(Company $companyId): self
    {
        if (!$this->company_id->contains($companyId)) {
            $this->company_id->add($companyId);
            $companyId->setRecruiter($this);
        }

        return $this;
    }

    public function removeCompanyId(Company $companyId): self
    {
        if ($this->company_id->removeElement($companyId)) {
            // set the owning side to null (unless already changed)
            if ($companyId->getRecruiter() === $this) {
                $companyId->setRecruiter(null);
            }
        }

        return $this;
    }

    public function getUserId(): ?User
    {
        return $this->user_id;
    }

    public function setUserId(User $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }

    /**
     * @return Collection<int, Announce>
     */
    public function getAnnounceId(): Collection
    {
        return $this->announce_id;
    }

    public function addAnnounceId(Announce $announceId): self
    {
        if (!$this->announce_id->contains($announceId)) {
            $this->announce_id->add($announceId);
            $announceId->setRecruiter($this);
        }

        return $this;
    }

    public function removeAnnounceId(Announce $announceId): self
    {
        if ($this->announce_id->removeElement($announceId)) {
            // set the owning side to null (unless already changed)
            if ($announceId->getRecruiter() === $this) {
                $announceId->setRecruiter(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, PublishValidation>
     */
    public function getPublishValidations(): Collection
    {
        return $this->publishValidations;
    }

    public function addPublishValidation(PublishValidation $publishValidation): self
    {
        if (!$this->publishValidations->contains($publishValidation)) {
            $this->publishValidations->add($publishValidation);
            $publishValidation->setRecruiter($this);
        }

        return $this;
    }

    public function removePublishValidation(PublishValidation $publishValidation): self
    {
        if ($this->publishValidations->removeElement($publishValidation)) {
            // set the owning side to null (unless already changed)
            if ($publishValidation->getRecruiter() === $this) {
                $publishValidation->setRecruiter(null);
            }
        }

        return $this;
    }
}
