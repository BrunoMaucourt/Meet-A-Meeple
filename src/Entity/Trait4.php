<?php

namespace App\Entity;

use App\Repository\Trait4Repository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: Trait4Repository::class)]
class Trait4
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $category_id = null;

    #[ORM\Column(length: 255)]
    private ?string $name_player = null;

    #[ORM\Column(length: 255)]
    private ?string $name_party = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategoryId(): ?int
    {
        return $this->category_id;
    }

    public function setCategoryId(int $category_id): self
    {
        $this->category_id = $category_id;

        return $this;
    }

    public function getNamePlayer(): ?string
    {
        return $this->name_player;
    }

    public function setNamePlayer(string $name_player): self
    {
        $this->name_player = $name_player;

        return $this;
    }

    public function getNameParty(): ?string
    {
        return $this->name_party;
    }

    public function setNameParty(string $name_party): self
    {
        $this->name_party = $name_party;

        return $this;
    }
}
