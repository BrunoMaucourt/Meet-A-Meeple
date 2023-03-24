<?php
//CHEMIN ÉVITANT DES INCOHÉRENCES
namespace App\Entity;
//CLASS UTILISER POUR LA PAGE PARTY.PHP
use App\Repository\PartyRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
//CRÉATION ET DÉFINITIONS DES COLONES POUR LA TABLE PARTY
#[ORM\Entity(repositoryClass: PartyRepository::class)]
class Party
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $user_host_ID = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $game = null;

    #[ORM\Column]
    private ?int $player_number_needed = null;

    #[ORM\Column]
    private ?int $player_number_total = null;

    #[ORM\Column(length: 255)]
    private ?string $address_location = null;

    #[ORM\Column]
    private ?float $address_GPS_lat = null;

    #[ORM\Column]
    private ?float $address_GPS_long = null;

    #[ORM\Column]
    private ?int $type_location_ID = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $last_sign_in = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\Column]
    private ?int $trait1_ID = null;

    #[ORM\Column]
    private ?int $trait2_ID = null;

    #[ORM\Column]
    private ?int $trait3_ID = null;

    #[ORM\Column]
    private ?int $trait4_ID = null;

    #[ORM\Column]
    private ?bool $canceled = null;

    /**
     * Add default values during construction of new user
     */
    public function __construct()
    {
        $this->created_at = new \DateTimeImmutable();
        $this->canceled = 0;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserHostID(): ?int
    {
        return $this->user_host_ID;
    }

    public function setUserHostID(int $user_host_ID): self
    {
        $this->user_host_ID = $user_host_ID;

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

    public function getGame(): ?string
    {
        return $this->game;
    }

    public function setGame(string $game): self
    {
        $this->game = $game;

        return $this;
    }

    public function getPlayerNumberNeeded(): ?int
    {
        return $this->player_number_needed;
    }

    public function setPlayerNumberNeeded(int $player_number_needed): self
    {
        $this->player_number_needed = $player_number_needed;

        return $this;
    }

    public function getPlayerNumberTotal(): ?int
    {
        return $this->player_number_total;
    }

    public function setPlayerNumberTotal(int $player_number_total): self
    {
        $this->player_number_total = $player_number_total;

        return $this;
    }

    public function getAddressLocation(): ?string
    {
        return $this->address_location;
    }

    public function setAddressLocation(string $address_location): self
    {
        $this->address_location = $address_location;

        return $this;
    }

    public function getAddressGPSLat(): ?float
    {
        return $this->address_GPS_lat;
    }

    public function setAddressGPSLat(float $address_GPS_Lat): self
    {
        $this->address_GPS_lat = $address_GPS_Lat;

        return $this;
    }

    public function getAddressGPSLong(): ?float
    {
        return $this->address_GPS_long;
    }

    public function setAddressGPSLong(float $address_GPS_long): self
    {
        $this->address_GPS_long = $address_GPS_long;

        return $this;
    }

    public function getTypeLocationID(): ?int
    {
        return $this->type_location_ID;
    }

    public function setTypeLocationID(int $type_location_ID): self
    {
        $this->type_location_ID = $type_location_ID;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getLastSignIn(): ?\DateTimeInterface
    {
        return $this->last_sign_in;
    }

    public function setLastSignIn(\DateTimeInterface $last_sign_in): self
    {
        $this->last_sign_in = $last_sign_in;

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

    public function isCanceled(): ?bool
    {
        return $this->canceled;
    }

    public function setCanceled(bool $canceled): self
    {
        $this->canceled = $canceled;

        return $this;
    }
}
