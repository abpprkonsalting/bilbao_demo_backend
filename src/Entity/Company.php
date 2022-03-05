<?php

namespace App\Entity;

use App\Repository\CompanyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CompanyRepository::class)
 */
class Company
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
     * @ORM\OneToMany(targetEntity=Request::class, mappedBy="importerCompany")
     */
    private $importerCompanyRequests;

    /**
     * @ORM\OneToMany(targetEntity=Request::class, mappedBy="finalClient")
     */
    private $finalClientRequests;

    public function __construct()
    {
        $this->importerCompanyRequests = new ArrayCollection();
        $this->finalClientRequests = new ArrayCollection();
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
     * @return Collection<int, Request>
     */
    public function getimporterCompanyRequests(): Collection
    {
        return $this->importerCompanyRequests;
    }

    public function addimporterCompanyRequest(Request $request): self
    {
        if (!$this->importerCompanyRequests->contains($request)) {
            $this->importerCompanyRequests[] = $request;
            $request->setImporterCompany($this);
        }

        return $this;
    }

    public function removeimporterCompanyRequest(Request $request): self
    {
        if ($this->importerCompanyRequests->removeElement($request)) {
            // set the owning side to null (unless already changed)
            if ($request->getImporterCompany() === $this) {
                $request->setImporterCompany(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Request>
     */
    public function getfinalClientRequests(): Collection
    {
        return $this->finalClientRequests;
    }

    public function addfinalClientRequest(Request $request): self
    {
        if (!$this->finalClientRequests->contains($request)) {
            $this->finalClientRequests[] = $request;
            $request->setFinalClient($this);
        }

        return $this;
    }

    public function removefinalClientRequest(Request $request): self
    {
        if ($this->finalClientRequests->removeElement($request)) {
            // set the owning side to null (unless already changed)
            if ($request->getFinalClient() === $this) {
                $request->setFinalClient(null);
            }
        }

        return $this;
    }
}
