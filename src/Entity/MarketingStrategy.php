<?php

namespace App\Entity;

use App\Repository\MarketingStrategyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;

/**
 * @ORM\Entity(repositoryClass=MarketingStrategyRepository::class)
 */
class MarketingStrategy
{

    const FOLLOW_THE_RABBIT = 1;
    const BIG_BANG = 2;
    const PIGGY_BACK = 3;
    const MARQUEE = 4;

    const SITUATIONS = [
        1 => [
            'name' => 'Follow the rabbit',
            'description' => "The business has already been established in a small market or closed market. Implement a strategy to offer your value propositions to a broader group of participants.",
            'examples' =>
                "Amazon used to sell books only from select producers. Using this strategy, Amazon opened it's service to all the sellers who wants to sell books and maximized its profit. Facebook started with providing service only in the Harvard campus and later opened it's service to general public. Intel improved its business by introducing wireless technology to the world."
            ,
        ],
        2 => [
            'name' => 'Big bang',
            'description' => "The business is new with no or less consumer-base and producer-base. To attract users, you will have to spend a lot of money to always come first in front of audience.However this strategy is also called a push strategy and is not an ideal strategy for startups and its effectiveness depends on the attractiveness of your value-proposition for the customer-segment.",
            'examples' =>
                "Twitter spent 11000$ to install giant flat-screen-televisions in SXSW festival and attracted a lot of users by showing each participant's twitter-sponsored game status on those giant televisions. Instagram gained thousands of users on the 1st day of it's launch because it spent huge money to be on the top in Apple's iTunes store."
            ,
        ],
        3 => [
            'name' => 'Piggyback',
            'description' => "The business is new with no consumer-base and producer-base. Collect consumers and producers by piggybacking on another platform by offering attractive incentives to both-sides (consumers and producers) or to any one-side.",
            'examples' =>"AirBnB collected it's early producers from CraigList. PayPal collected it's early consumers and producers from Ebay by providing incentives to both parties. Youtube attracted a large set of producers from MySpace by providing easy tools to upload videos."
        ],
        4 => [
            'name' => 'Marquee',
            'description' => "Marquee users can be consumers or producers whose presence in the platform attracts the other side of users.",
            'examples' => 'PayPal acquired a lot of consumers with incentives which then attracted producers to open account with PayPal. Microsoft acquired the HALO franchise which attracted a lot of gamers both on XBOX and PC platform. Youtube attracted inidie band producers from MySpace whose video contents attracted a lot of audience.'
        ]
    ];

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
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $channel;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $examples;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CustomerSegment", inversedBy="marketingStrategy")
     * @JoinColumn(name="customerSegment_id", referencedColumnName="id")
     */
    private $customerSegment;

    public function getId()
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
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param $strategyType
     */
    public function setType($strategyType)
    {
        $this->type = $strategyType;
    }


    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getExamples()
    {
        return $this->examples;
    }

    /**
     * @param mixed $examples
     */
    public function setExamples($examples)
    {
        $this->examples = $examples;
    }

    /**
     * @return mixed
     */
    public function getCustomerSegment()
    {
        return $this->customerSegment;
    }

    /**
     * @param mixed $customerSegment
     */
    public function setCustomerSegment($customerSegment): void
    {
        $this->customerSegment = $customerSegment;
    }

    /**
     * @return mixed
     */
    public function getChannel()
    {
        return $this->channel;
    }

    /**
     * @param mixed $channel
     */
    public function setChannel($channel): void
    {
        $this->channel = $channel;
    }

}
