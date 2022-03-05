<?php

namespace App\Entity;

use App\Repository\RequestRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RequestRepository::class)
 */
class Request
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Company::class, inversedBy="importerCompanyRequests")
     * @ORM\JoinColumn(nullable=false)
     */
    private $importerCompany;

    /**
     * @ORM\ManyToOne(targetEntity=Specialist::class, inversedBy="requests")
     * @ORM\JoinColumn(nullable=false)
     */
    private $specialist;

    /**
     * @ORM\ManyToOne(targetEntity=Material::class, inversedBy="requests")
     * @ORM\JoinColumn(nullable=false)
     */
    private $requestedMaterial;

    /**
     * @ORM\ManyToOne(targetEntity=Company::class, inversedBy="finalClientRequests")
     * @ORM\JoinColumn(nullable=false)
     */
    private $finalClient;

    /**
     * @ORM\ManyToOne(targetEntity=Unit::class, inversedBy="requests")
     * @ORM\JoinColumn(nullable=false)
     */
    private $unit;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantity;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\Column(type="datetime")
     */
    private $validUntil;

    /**
     * @ORM\OneToOne(targetEntity=BusinessOportunity::class, mappedBy="request", cascade={"persist", "remove"})
     */
    private $businessOportunity;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImporterCompany(): ?Company
    {
        return $this->importerCompany;
    }

    public function setImporterCompany(?Company $importerCompany): self
    {
        $this->importerCompany = $importerCompany;

        return $this;
    }

    public function getSpecialist(): ?Specialist
    {
        return $this->specialist;
    }

    public function setSpecialist(?Specialist $specialist): self
    {
        $this->specialist = $specialist;

        return $this;
    }

    public function getRequestedMaterial(): ?Material
    {
        return $this->requestedMaterial;
    }

    public function setRequestedMaterial(?Material $requestedMaterial): self
    {
        $this->requestedMaterial = $requestedMaterial;

        return $this;
    }

    public function getFinalClient(): ?Company
    {
        return $this->finalClient;
    }

    public function setFinalClient(?Company $finalClient): self
    {
        $this->finalClient = $finalClient;

        return $this;
    }

    public function getUnit(): ?Unit
    {
        return $this->unit;
    }

    public function setUnit(?Unit $unit): self
    {
        $this->unit = $unit;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getValidUntil(): ?\DateTimeInterface
    {
        return $this->validUntil;
    }

    public function setValidUntil(\DateTimeInterface $validUntil): self
    {
        $this->validUntil = $validUntil;

        return $this;
    }

    public function getBusinessOportunity(): ?BusinessOportunity
    {
        return $this->businessOportunity;
    }

    public function setBusinessOportunity(BusinessOportunity $businessOportunity): self
    {
        // set the owning side of the relation if necessary
        if ($businessOportunity->getRequest() !== $this) {
            $businessOportunity->setRequest($this);
        }

        $this->businessOportunity = $businessOportunity;

        return $this;
    }
}
