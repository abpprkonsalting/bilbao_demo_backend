<?php

namespace App\Entity\Statuses;

use App\Entity\ContractStatus;
use App\Repository\Statuses\CStatusRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CStatusRepository::class)
 */
class CStatus
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
     * @ORM\OneToMany(targetEntity=ContractStatus::class, mappedBy="status", orphanRemoval=true)
     */
    private $contractStatuses;

    public function __construct()
    {
        $this->contractStatuses = new ArrayCollection();
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
     * @return Collection<int, ContractStatus>
     */
    public function getContractStatuses(): Collection
    {
        return $this->contractStatuses;
    }

    public function addContractStatus(ContractStatus $contractStatus): self
    {
        if (!$this->contractStatuses->contains($contractStatus)) {
            $this->contractStatuses[] = $contractStatus;
            $contractStatus->setStatus($this);
        }

        return $this;
    }

    public function removeContractStatus(ContractStatus $contractStatus): self
    {
        if ($this->contractStatuses->removeElement($contractStatus)) {
            // set the owning side to null (unless already changed)
            if ($contractStatus->getStatus() === $this) {
                $contractStatus->setStatus(null);
            }
        }

        return $this;
    }
}
