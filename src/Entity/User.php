<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $lastName = null;

    #[ORM\Column(length: 255)]
    private ?string $firstName = null;

    #[ORM\Column]
    private ?int $gender_ID = null;

    #[ORM\Column(length: 255)]
    private ?string $pseudo = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $birthdate = null;

    #[ORM\Column(length: 255)]
    private ?string $city = null;

    #[ORM\Column]
    private ?int $city_GPS_lat = null;

    #[ORM\Column]
    private ?int $city_GPS_long = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $favoriteGame = null;

    #[ORM\Column]
    private ?int $trait1_ID = null;

    #[ORM\Column]
    private ?int $trait2_ID = null;

    #[ORM\Column]
    private ?int $trait3_ID = null;

    #[ORM\Column]
    private ?int $trait4_ID = null;

    #[ORM\Column(length: 255)]
    private ?string $pictureProfil = null;

    #[ORM\Column]
    private ?int $user_level_ID = null;

    #[ORM\Column]
    private ?float $rate = null;

    #[ORM\Column]
    private ?int $absence = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $lastConnexion = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getGender(): ?int
    {
        return $this->gender_ID;
    }

    public function setGender(int $gender): self
    {
        $this->gender_ID = $gender;

        return $this;
    }

    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    public function setPseudo(string $pseudo): self
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    public function getBirthdate(): ?\DateTimeInterface
    {
        return $this->birthdate;
    }

    public function setBirthdate(\DateTimeInterface $birthdate): self
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getCityGPSLat(): ?int
    {
        return $this->city_GPS_lat;
    }

    public function setCityGPSLat(int $city_GPS_lat): self
    {
        $this->city_GPS_lat = $city_GPS_lat;

        return $this;
    }

    public function getCityGPSLong(): ?int
    {
        return $this->city_GPS_long;
    }

    public function setCityGPSLong(int $city_GPS_long): self
    {
        $this->city_GPS_long = $city_GPS_long;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getFavoriteGame(): ?string
    {
        return $this->favoriteGame;
    }

    public function setFavoriteGame(string $favoriteGame): self
    {
        $this->favoriteGame = $favoriteGame;

        return $this;
    }

    public function getTrait1ID(): ?int
    {
        return $this->trait1_ID;
    }

    public function setTrait1ID(int $trait1_ID): self
    {
        $this->trait1_ID = $trait1_ID;

        return $this;
    }

    public function getTrait2ID(): ?int
    {
        return $this->trait2_ID;
    }

    public function setTrait2ID(int $trait2_ID): self
    {
        $this->trait2_ID = $trait2_ID;

        return $this;
    }

    public function getTrait3ID(): ?int
    {
        return $this->trait3_ID;
    }

    public function setTrait3ID(int $trait3_ID): self
    {
        $this->trait3_ID = $trait3_ID;

        return $this;
    }

    public function getTrait4ID(): ?int
    {
        return $this->trait4_ID;
    }

    public function setTrait4ID(int $trait4_ID): self
    {
        $this->trait4_ID = $trait4_ID;

        return $this;
    }

    public function getPictureProfil(): ?string
    {
        return $this->pictureProfil;
    }

    public function setPictureProfil(string $pictureProfil): self
    {
        $this->pictureProfil = $pictureProfil;

        return $this;
    }

    public function getUserLevelID(): ?int
    {
        return $this->user_level_ID;
    }

    public function setUserLevelID(int $user_level_ID): self
    {
        $this->user_level_ID = $user_level_ID;

        return $this;
    }

    public function getRate(): ?float
    {
        return $this->rate;
    }

    public function setRate(float $rate): self
    {
        $this->rate = $rate;

        return $this;
    }

    public function getAbsence(): ?int
    {
        return $this->absence;
    }

    public function setAbsence(int $absence): self
    {
        $this->absence = $absence;

        return $this;
    }

    public function getLastConnexion(): ?\DateTimeInterface
    {
        return $this->lastConnexion;
    }

    public function setLastConnexion(\DateTimeInterface $lastConnexion): self
    {
        $this->lastConnexion = $lastConnexion;

        return $this;
    }
}
