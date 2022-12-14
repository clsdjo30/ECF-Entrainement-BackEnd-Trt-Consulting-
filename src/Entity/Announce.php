<?php

namespace App\Entity;

use App\Repository\AnnounceRepository;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation\Slug;
use Gedmo\Mapping\Annotation\Timestampable;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


#[ORM\Entity(repositoryClass: AnnounceRepository::class)]
#[UniqueEntity(fields: ['slug'], message: 'announce.slug_unique', errorPath: 'title')]
class Announce
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $experience = null;

    #[ORM\Column]
    private ?int $salary = null;

    #[ORM\Column(length: 255)]
    private ?string $hourly = null;

    #[ORM\Column(length: 255)]
    private ?string $benefits = null;

    #[ORM\Column(length: 255)]
    #[Slug(fields: ["title"])]
    private ?string $slug = null;

    #[ORM\Column]
    private ?bool $isValid = null;

    #[ORM\Column(type: 'datetime')]
    #[Timestampable(on: 'create')]
    private ?DateTimeInterface $createdAt = null;

    #[ORM\Column(type: 'datetime')]
    #[Timestampable(on: 'update')]
    private ?DateTimeInterface $updatedAt = null;

    #[ORM\ManyToOne(cascade: ['persist'], inversedBy: 'announces')]
    #[ORM\JoinColumn(nullable: true)]
    private ?Category $category = null;

    #[ORM\ManyToOne(cascade: ['persist', 'remove'], inversedBy: 'announce_id')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Recruiter $recruiter = null;

    #[ORM\OneToMany(mappedBy: 'announce', targetEntity: ApplyValidation::class, orphanRemoval: true)]
    private Collection $appliedCandidates;

    public function __construct()
    {
        $this->appliedCandidates = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getExperience(): ?string
    {
        return $this->experience;
    }

    public function setExperience(string $experience): self
    {
        $this->experience = $experience;

        return $this;
    }

    public function getSalary(): ?int
    {
        return $this->salary;
    }

    public function setSalary(int $salary): self
    {
        $this->salary = $salary;

        return $this;
    }

    public function getHourly(): ?string
    {
        return $this->hourly;
    }

    public function setHourly(string $hourly): self
    {
        $this->hourly = $hourly;

        return $this;
    }

    public function getBenefits(): ?string
    {
        return $this->benefits;
    }

    public function setBenefits(string $benefits): self
    {
        $this->benefits = $benefits;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function isIsValid(): ?bool
    {
        return $this->isValid;
    }

    public function setIsValid(bool $isValid): self
    {
        $this->isValid = $isValid;

        return $this;
    }

    public function getCreatedAt(): ?DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
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

    public function addAppliedCandidate(ApplyValidation $appliedCandidate): self
    {
        if (!$this->appliedCandidates->contains($appliedCandidate)) {
            $this->appliedCandidates->add($appliedCandidate);
            $appliedCandidate->setAnnounce($this);
        }

        return $this;
    }

    public function removeAppliedCandidate(ApplyValidation $appliedCandidate): self
    {
        if ($this->appliedCandidates->removeElement($appliedCandidate)) {
            // set the owning side to null (unless already changed)
            if ($appliedCandidate->getAnnounce() === $this) {
                $appliedCandidate->setAnnounce(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->recruiter->getCompanyName();
    }

    public function isApplied(Candidate $candidate): int
    {
        return !$this->getAppliedCandidates()->filter(function (ApplyValidation $applyValidation) use ($candidate) {
            return $applyValidation->getCandidate() === $candidate;

        }
        )->isEmpty();
    }

    /**
     * @return Collection<int, ApplyValidation>
     */
    public function getAppliedCandidates(): Collection
    {
        return $this->appliedCandidates;
    }
}
