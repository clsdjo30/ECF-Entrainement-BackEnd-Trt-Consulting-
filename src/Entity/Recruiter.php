<?php

namespace App\Entity;

use App\Repository\RecruiterRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: RecruiterRepository::class)]
class Recruiter
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToMany(mappedBy: 'recruiter', targetEntity: Announce::class, orphanRemoval: true)]
    private Collection $announce_id;

    #[ORM\OneToOne(mappedBy: 'recruiter', cascade: ['persist', 'remove'])]
    private ?User $user_id = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\NotBlank]
    private ?string $address = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\NotBlank]
    private ?string $city = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\NotBlank]
    private ?string $country = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\NotBlank]
    private ?int $postal_code = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $company_name = null;

    public function __construct()
    {
        $this->announce_id = new ArrayCollection();
        $this->publishValidations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function __toString(): string
    {
        return $this->getUserId();
    }

    public function getUserId(): ?User
    {
        return $this->user_id;
    }

    public function setUserId(?User $user_id): self
    {
        // unset the owning side of the relation if necessary
        if ($user_id === null && $this->user_id !== null) {
            $this->user_id->setRecruiter(null);
        }

        // set the owning side of the relation if necessary
        if ($user_id !== null && $user_id->getRecruiter() !== $this) {
            $user_id->setRecruiter($this);
        }

        $this->user_id = $user_id;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getPostalCode(): ?int
    {
        return $this->postal_code;
    }

    public function setPostalCode(int $postal_code): self
    {
        $this->postal_code = $postal_code;

        return $this;
    }

    public function getCompanyName(): ?string
    {
        return $this->company_name;
    }

    public function setCompanyName(string $company_name): self
    {
        $this->company_name = $company_name;

        return $this;
    }

}
