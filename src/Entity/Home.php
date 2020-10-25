<?php

namespace App\Entity;

use App\Repository\HomeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=HomeRepository::class)
 */
class Home
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="object", nullable=true)
     */
    private $delta;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User", inversedBy="home")
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDelta()
    {
        return $this->delta;
    }

    public function setDelta($delta): self
    {
        $this->delta = $delta;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user): void
    {
        $this->user = $user;
    }

}
