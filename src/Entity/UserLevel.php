<?php

namespace App\Entity;

use App\Repository\UserLevelRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserLevelRepository::class)]
class UserLevel
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $picture_profil = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPictureProfil(): ?string
    {
        return $this->picture_profil;
    }

    public function setPictureProfil(string $picture_profil): self
    {
        $this->picture_profil = $picture_profil;

        return $this;
    }
}
