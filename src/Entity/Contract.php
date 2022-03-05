<?php

namespace App\Entity;

use App\Repository\ContractRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ContractRepository::class)
 */
class Contract
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $amount;

    /**
     * @ORM\ManyToOne(targetEntity=Currency::class, inversedBy="contracts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $currency;

    /**
     * @ORM\ManyToOne(targetEntity=DeliveryConditions::class, inversedBy="contracts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $deliveryConditions;

    /**
     * @ORM\ManyToOne(targetEntity=ContractStatus::class, inversedBy="contracts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $status;

    /**
     * @ORM\OneToOne(targetEntity=BusinessOportunity::class, mappedBy="contract", cascade={"persist", "remove"})
     */
    private $businessOportunity;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAmount(): ?int
    {
        return $this->amount;
    }

    public function setAmount(int $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getCurrency(): ?Currency
    {
        return $this->currency;
    }

    public function setCurrency(?Currency $currency): self
    {
        $this->currency = $currency;

        return $this;
    }

    public function getDeliveryConditions(): ?DeliveryConditions
    {
        return $this->deliveryConditions;
    }

    public function setDeliveryConditions(?DeliveryConditions $deliveryConditions): self
    {
        $this->deliveryConditions = $deliveryConditions;

        return $this;
    }

    public function getStatus(): ?ContractStatus
    {
        return $this->status;
    }

    public function setStatus(?ContractStatus $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getBusinessOportunity(): ?BusinessOportunity
    {
        return $this->businessOportunity;
    }

    public function setBusinessOportunity(?BusinessOportunity $businessOportunity): self
    {
        // unset the owning side of the relation if necessary
        if ($businessOportunity === null && $this->businessOportunity !== null) {
            $this->businessOportunity->setContract(null);
        }

        // set the owning side of the relation if necessary
        if ($businessOportunity !== null && $businessOportunity->getContract() !== $this) {
            $businessOportunity->setContract($this);
        }

        $this->businessOportunity = $businessOportunity;

        return $this;
    }
}
