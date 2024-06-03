<?php

namespace App\Entity;

use App\Repository\OrderEntityRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: OrderEntityRepository::class)]
class OrderEntity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    #[Assert\NotBlank]
    private ?int $SupplierId = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    private ?string $Product = null;

    #[ORM\Column]
    #[Assert\NotBlank]
    private ?int $Quantity = null;

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getSupplierId(): ?int
    {
        return $this->SupplierId;
    }

    public function setSupplierId(int $SupplierId): static
    {
        $this->SupplierId = $SupplierId;

        return $this;
    }

    public function getProduct(): ?string
    {
        return $this->Product;
    }

    public function setProduct(string $Product): static
    {
        $this->Product = $Product;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->Quantity;
    }

    public function setQuantity(int $Quantity): static
    {
        $this->Quantity = $Quantity;

        return $this;
    }
}
