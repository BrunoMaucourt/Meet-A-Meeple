<?php

namespace App\Entity;

use App\Repository\UserBlackListRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserBlackListRepository::class)]
class UserBlackList
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;
    
    #[ORM\Column]
    private ?int $userThatBlock_ID = null;

    #[ORM\Column]
    private ?int $userBanned_ID = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserThatBlockID(): ?int
    {
        return $this->userThatBlock_ID;
    }

    public function setUserThatBlockID(int $userThatBlock_ID): self
    {
        $this->userThatBlock_ID = $userThatBlock_ID;

        return $this;
    }

    public function getUserBannedID(): ?int
    {
        return $this->userBanned_ID;
    }

    public function setUserBannedID(int $userBanned_ID): self
    {
        $this->userBanned_ID = $userBanned_ID;

        return $this;
    }
}
