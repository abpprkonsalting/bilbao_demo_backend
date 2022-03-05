<?php

namespace App\Entity;

use App\Repository\BusinessOportunityRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BusinessOportunityRepository::class)
 */
class BusinessOportunity
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=Request::class, inversedBy="businessOportunity", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $request;

    /**
     * @ORM\OneToOne(targetEntity=Offer::class, inversedBy="businessOportunity", cascade={"persist", "remove"})
     */
    private $offer;

    /**
     * @ORM\OneToOne(targetEntity=Contract::class, inversedBy="businessOportunity", cascade={"persist", "remove"})
     */
    private $contract;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRequest(): ?Request
    {
        return $this->request;
    }

    public function setRequest(Request $request): self
    {
        $this->request = $request;

        return $this;
    }

    public function getOffer(): ?Offer
    {
        return $this->offer;
    }

    public function setOffer(?Offer $offer): self
    {
        $this->offer = $offer;

        return $this;
    }

    public function getContract(): ?Contract
    {
        return $this->contract;
    }

    public function setContract(?Contract $contract): self
    {
        $this->contract = $contract;

        return $this;
    }
}
