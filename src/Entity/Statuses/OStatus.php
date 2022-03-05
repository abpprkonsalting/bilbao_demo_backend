<?php

namespace App\Entity\Statuses;

use App\Entity\Offer;
use App\Entity\OfferStatus;
use App\Repository\Statuses\OStatusRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OStatusRepository::class)
 */
class OStatus
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=OfferStatus::class, mappedBy="status", orphanRemoval=true)
     */
    private $offerStatuses;

    public function __construct()
    {
        $this->offerStatuses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, OfferStatus>
     */
    public function getOfferStatuses(): Collection
    {
        return $this->offerStatuses;
    }

    public function addOfferStatus(OfferStatus $offerStatus): self
    {
        if (!$this->offerStatuses->contains($offerStatus)) {
            $this->offerStatuses[] = $offerStatus;
            $offerStatus->setStatus($this);
        }

        return $this;
    }

    public function removeOfferStatus(OfferStatus $offerStatus): self
    {
        if ($this->offerStatuses->removeElement($offerStatus)) {
            // set the owning side to null (unless already changed)
            if ($offerStatus->getStatus() === $this) {
                $offerStatus->setStatus(null);
            }
        }

        return $this;
    }

}
