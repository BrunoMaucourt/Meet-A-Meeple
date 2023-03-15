<?php

namespace App\Entity;

use App\Repository\DisplayChatRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DisplayChatRepository::class)]
class DisplayChat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $user_sender_ID = null;

    #[ORM\Column]
    private ?int $user_recipient_ID = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserSenderID(): ?int
    {
        return $this->user_sender_ID;
    }

    public function setUserSenderID(int $user_sender_ID): self
    {
        $this->user_sender_ID = $user_sender_ID;

        return $this;
    }

    public function getUserRecipientID(): ?int
    {
        return $this->user_recipient_ID;
    }

    public function setUserRecipientID(int $user_recipient_ID): self
    {
        $this->user_recipient_ID = $user_recipient_ID;

        return $this;
    }
}
