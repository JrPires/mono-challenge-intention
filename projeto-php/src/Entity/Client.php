<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClientRepository::class)]
class Client
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 70)]
    private ?string $nome = null;

    #[ORM\ManyToOne(targetEntity: Address::class, cascade: ['persist'], inversedBy: 'clients')]
    #[ORM\JoinColumn(name: "address_id", referencedColumnName: "id")]
    private ?Address $address_id = null;

    public function __construct()
    {
        $this->produto_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNome(): ?string
    {
        return $this->nome;
    }

    public function setNome(string $nome): self
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * @return Address|null
     */
    public function getAddressId(): ?Address
    {
        return $this->address_id;
    }

    /**
     * @param Address|null $address_id
     */
    public function setAddressId(?Address $address_id): void
    {
        $this->address_id = $address_id;
    }
//    /**
//     * @return Product
//     */
//    public function getProductId(): Product
//    {
//        return $this->product_id;
//    }
//
//    /**
//     * @param Product $product_id
//     */
//    public function setProductId(Product $product_id): void
//    {
//        $this->product_id = $product_id;
//    }
}
