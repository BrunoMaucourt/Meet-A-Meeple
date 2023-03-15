<?php

namespace App\Entity;

use App\Repository\UserChatRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserChatRepository::class)]
class UserChat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $user_sender_ID = null;

    #[ORM\Column]
    private ?int $user_recipient_ID = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $body = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $creataed_at = null;

    #[ORM\Column]
    private ?bool $messageRead = null;

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

    public function getBody(): ?string
    {
        return $this->body;
    }

    public function setBody(string $body): self
    {
        $this->body = $body;

        return $this;
    }

    public function getCreataedAt(): ?\DateTimeImmutable
    {
        return $this->creataed_at;
    }

    public function setCreataedAt(\DateTimeImmutable $creataed_at): self
    {
        $this->creataed_at = $creataed_at;

        return $this;
    }

    public function isMessageRead(): ?bool
    {
        return $this->messageRead;
    }

    public function setMessageRead(bool $messageRead): self
    {
        $this->messageRead = $messageRead;

        return $this;
    }
}
