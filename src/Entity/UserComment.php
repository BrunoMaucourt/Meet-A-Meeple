<?php

namespace App\Entity;

use App\Repository\UserCommentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserCommentRepository::class)]
class UserComment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $sender_user_ID = null;

    #[ORM\Column]
    private ?int $concerned_user_ID = null;

    #[ORM\Column]
    private ?int $party_ID = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\Column]
    private ?bool $read_by_concerned_user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSenderUserID(): ?int
    {
        return $this->sender_user_ID;
    }

    public function setSenderUserID(int $sender_user_ID): self
    {
        $this->sender_user_ID = $sender_user_ID;

        return $this;
    }

    public function getConcernedUserID(): ?int
    {
        return $this->concerned_user_ID;
    }

    public function setConcernedUserID(int $concerned_user_ID): self
    {
        $this->concerned_user_ID = $concerned_user_ID;

        return $this;
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

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function isReadByConcernedUser(): ?bool
    {
        return $this->read_by_concerned_user;
    }

    public function setReadByConcernedUser(bool $read_by_concerned_user): self
    {
        $this->read_by_concerned_user = $read_by_concerned_user;

        return $this;
    }
}
