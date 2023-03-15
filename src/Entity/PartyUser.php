<?php

namespace App\Entity;

use App\Repository\PartyUserRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PartyUserRepository::class)]
class PartyUser
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $party_ID = null;

    #[ORM\Column]
    private ?int $user_ID = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPartyID(): ?int
    {
        return $this->party_ID;
    }

    public function setPartyID(int $party_ID): self
    {
        $this->party_ID = $party_ID;

        return $this;
    }

    public function getUserID(): ?int
    {
        return $this->user_ID;
    }

    public function setUserID(int $user_ID): self
    {
        $this->user_ID = $user_ID;

        return $this;
    }
}
