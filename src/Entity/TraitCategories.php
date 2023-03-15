<?php

namespace App\Entity;

use App\Repository\TraitCategoriesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TraitCategoriesRepository::class)]
class TraitCategories
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $category_ID = null;

    #[ORM\Column(length: 255)]
    private ?string $category_name = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategoryID(): ?int
    {
        return $this->category_ID;
    }

    public function setCategoryID(int $category_ID): self
    {
        $this->category_ID = $category_ID;

        return $this;
    }

    public function getCategoryName(): ?string
    {
        return $this->category_name;
    }

    public function setCategoryName(string $category_name): self
    {
        $this->category_name = $category_name;

        return $this;
    }
}
