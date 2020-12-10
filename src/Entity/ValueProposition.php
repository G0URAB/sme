<?php

namespace App\Entity;

use App\Repository\ValuePropositionRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;

/**
 * @ORM\Entity(repositoryClass=ValuePropositionRepository::class)
 */
class ValueProposition
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
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CustomerSegment", inversedBy="valuePropositions")
     * @JoinColumn(name="customerSegment_id", referencedColumnName="id")
     */
    private $customerSegment;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    public function setCustomerSegment(CustomerSegment $customerSegment)
    {
        $this->customerSegment = $customerSegment;
    }

    /**
     * @return mixed
     */
    public function getCustomerSegment()
    {
        return $this->customerSegment;
    }

}
