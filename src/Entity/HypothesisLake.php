<?php

namespace App\Entity;

use App\Repository\HypothesisLakeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=HypothesisLakeRepository::class)
 */
class HypothesisLake
{

    const BUSINESS_TYPES= [
      0 => 'B2C Hardware business',
      1 => 'B2C Software business',
      2 => 'B2C Service business',
      3 => 'B2B Hardware business',
      4 => 'B2B Software business',
      5 => 'B2B Service business',
    ];

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", length=100, nullable=false)
     */
    private $phase;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $nameOfBusiness;

    /**
     * @ORM\Column(type="integer", length=255, nullable=false)
     */
    private $businessType;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CustomerSegment", mappedBy="hypothesisLake")
     */
    private $customerSegments;

    public function __construct()
    {
        $this->customerSegments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return ArrayCollection
     */
    public function getCustomerSegments()
    {
        return $this->customerSegments;
    }

    public function removeCustomerSegment($customerSegment)
    {
        $this->customerSegments->removeElement($customerSegment);
    }

    public function addCustomerSegment(CustomerSegment $customerSegment): void
    {
        $customerSegment->setHypothesisLake($this);
        if(!$this->customerSegments->contains($customerSegment))
            $this->customerSegments->add($customerSegment);
    }

    /**
     * @return mixed
     */
    public function getNameOfBusiness()
    {
        return $this->nameOfBusiness;
    }

    /**
     * @param mixed $nameOfBusiness
     */
    public function setNameOfBusiness($nameOfBusiness): void
    {
        $this->nameOfBusiness = $nameOfBusiness;
    }

    /**
     * @return mixed
     */
    public function getPhase()
    {
        return $this->phase;
    }

    /**
     * @param mixed $phase
     */
    public function setPhase($phase)
    {
        $this->phase = $phase;
    }

    /**
     * @return mixed
     */
    public function getBusinessType()
    {
        return $this->businessType;
    }

    /**
     * @param mixed $businessType
     */
    public function setBusinessType($businessType)
    {
        $this->businessType = $businessType;
    }

}
