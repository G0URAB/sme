<?php

namespace App\Entity;

use App\Repository\CustomerSegmentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;

/**
 * @ORM\Entity(repositoryClass=CustomerSegmentRepository::class)
 */
class CustomerSegment
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
     * @ORM\ManyToOne(targetEntity="App\Entity\HypothesisLake", inversedBy="customerSegments")
     * @JoinColumn(name="hypothesisLake_id", referencedColumnName="id")
     */
    private $hypothesisLake;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ValueProposition", mappedBy="customerSegment")
     */
    private $valuePropositions;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\MarketingStrategy", mappedBy="customerSegment", cascade={"persist","remove"})
     * @JoinColumn(name="marketingStrategies", referencedColumnName="id")
     */
    private $marketingStrategies;

    public function __construct()
    {
        $this->valuePropositions = new ArrayCollection();
        $this->marketingStrategies = new ArrayCollection();
    }

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

    /**
     * @return ArrayCollection
     */
    public function getValuePropositions()
    {
        return $this->valuePropositions;
    }

    public function removeValueProposition($valueProposition)
    {
        $this->valuePropositions->removeElement($valueProposition);
    }

    public function addValueProposition(ValueProposition $valueProposition): void
    {
        $valueProposition->setCustomerSegment($this);
        if(!$this->valuePropositions->contains($valueProposition))
          $this->valuePropositions->add($valueProposition);
    }

    public function setHypothesisLake(HypothesisLake $hypothesisLake)
    {
        $this->hypothesisLake = $hypothesisLake;
    }

    public function getMarketingStrategies()
    {
        return $this->valuePropositions;
    }

    public function removeMarketingStrategy($strategy)
    {
        $this->marketingStrategies->removeElement($strategy);
    }

    public function addMarketingStrategy(MarketingStrategy $strategy): void
    {
        $strategy->setCustomerSegment($this);
        if(!$this->marketingStrategies->contains($strategy))
            $this->marketingStrategies->add($strategy);
    }
}
