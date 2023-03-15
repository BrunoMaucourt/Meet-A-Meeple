<?php

namespace App\Entity;

use App\Repository\UserFriendRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserFriendRepository::class)]
class UserFriend
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $user_ID = null;

    #[ORM\Column]
    private ?int $user_friend_ID = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getUserFriendID(): ?int
    {
        return $this->user_friend_ID;
    }

    public function setUserFriendID(int $user_friend_ID): self
    {
        $this->user_friend_ID = $user_friend_ID;

        return $this;
    }
}
