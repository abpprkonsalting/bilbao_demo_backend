<?php

namespace App\Entity;

use App\Entity\Statuses\OStatus;
use App\Repository\OfferRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OfferRepository::class)
 */
class Offer
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
    private $amountFob;

    /**
     * @ORM\Column(type="integer")
     */
    private $amountTotal;

    /**
     * @ORM\ManyToOne(targetEntity=Currency::class, inversedBy="offers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $currency;

    /**
     * @ORM\ManyToOne(targetEntity=PaymentMethod::class, inversedBy="offers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $paymentMethod;

    /**
     * @ORM\ManyToOne(targetEntity=OfferStatus::class, inversedBy="offers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $status;

    /**
     * @ORM\ManyToOne(targetEntity=RejectedReason::class, inversedBy="offers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $rejectedReason;

    /**
     * @ORM\OneToOne(targetEntity=BusinessOportunity::class, mappedBy="offer", cascade={"persist", "remove"})
     */
    private $businessOportunity;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAmountFob(): ?int
    {
        return $this->amountFob;
    }

    public function setAmountFob(int $amountFob): self
    {
        $this->amountFob = $amountFob;

        return $this;
    }

    public function getAmountTotal(): ?int
    {
        return $this->amountTotal;
    }

    public function setAmountTotal(int $amountTotal): self
    {
        $this->amountTotal = $amountTotal;

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

    public function getPaymentMethod(): ?PaymentMethod
    {
        return $this->paymentMethod;
    }

    public function setPaymentMethod(?PaymentMethod $paymentMethod): self
    {
        $this->paymentMethod = $paymentMethod;

        return $this;
    }

    public function getStatus(): ?OfferStatus
    {
        return $this->status;
    }

    public function setStatus(?OfferStatus $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getRejectedReason(): ?RejectedReason
    {
        return $this->rejectedReason;
    }

    public function setRejectedReason(?RejectedReason $rejectedReason): self
    {
        $this->rejectedReason = $rejectedReason;

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
            $this->businessOportunity->setOffer(null);
        }

        // set the owning side of the relation if necessary
        if ($businessOportunity !== null && $businessOportunity->getOffer() !== $this) {
            $businessOportunity->setOffer($this);
        }

        $this->businessOportunity = $businessOportunity;

        return $this;
    }
}
