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
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $nameOfBusiness;

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

}
