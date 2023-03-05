<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Core\Annotation\ApiResource;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
#[ApiResource(
    collectionOperations:["get"],
    itemOperations:[],
)]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, unique: true)]
    private ?string $name = null;

    #[ORM\Column(nullable: false, options: ['default' => 0])]
    #[Assert\GreaterThanOrEquals(propertyPath:"stock")]
    private ?int $stockage_capacity = null;

    #[ORM\Column(nullable: false, options: ['default' => 0])]
    #[Assert\LessThanOrEquals(propertyPath:"stockage_capacity")]
    private ?int $stock = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 5, scale: 2)]
    private ?string $price = null;


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

    public function getStockageCapacity(): ?int
    {
        return $this->stockage_capacity;
    }

    public function setStockageCapacity(int $stockage_capacity): self
    {
        $this->stockage_capacity = $stockage_capacity;

        return $this;
    }

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(?int $stock): self
    {
        $this->stock = $stock;

        return $this;
    }
    
    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): self
    {
        $this->price = $price;

        return $this;
    }
}
