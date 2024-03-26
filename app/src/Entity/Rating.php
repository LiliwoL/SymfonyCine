<?php

namespace App\Entity;

use App\Repository\RatingRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RatingRepository::class)]
class Rating
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $idMovie = null;

    #[ORM\Column(length: 255)]
    private ?string $nickname = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $rate = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdMovie(): ?string
    {
        return $this->idMovie;
    }

    public function setIdMovie(string $idMovie): static
    {
        $this->idMovie = $idMovie;

        return $this;
    }

    public function getNickname(): ?string
    {
        return $this->nickname;
    }

    public function setNickname(string $nickname): static
    {
        $this->nickname = $nickname;

        return $this;
    }

    public function getRate(): ?int
    {
        return $this->rate;
    }

    public function setRate(int $rate): static
    {
        $this->rate = $rate;

        return $this;
    }
}
