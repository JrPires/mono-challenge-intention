<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $title = null;

    #[ORM\Column]
    private ?float $price = null;

    #[ORM\Column(length: 500)]
    private ?string $description = null;

    #[ORM\Column(length: 50)]
    private ?string $category = null;

    #[ORM\Column(length: 200)]
    private ?string $image = null;

    #[ORM\OneToMany(mappedBy: 'rating_id', targetEntity: Rating::class)]
    private Collection $rating_id;

    public function __construct()
    {
        $this->rating_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

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

    /**
     * @return string|null
     */
    public function getCategory(): ?string
    {
        return $this->category;
    }

    /**
     * @param string|null $category
     */
    public function setCategory(?string $category): void
    {
        $this->category = $category;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getRatingId(): Collection
    {
        return $this->rating_id;
    }

    /**
     * @param Collection $rating_id
     */
    public function setRatingId(Collection $rating_id): void
    {
        $this->rating_id = $rating_id;
    }

    public function addRatingId(Rating $ratingId): self
    {
        if (!$this->rating_id->contains($ratingId)) {
            $this->rating_id->add($ratingId);
            $ratingId->setRatingId($this);
        }

        return $this;
    }

    public function removeRatingId(Rating $ratingId): self
    {
        if ($this->rating_id->removeElement($ratingId)) {
            // set the owning side to null (unless already changed)
            if ($ratingId->getRatingId() === $this) {
                $ratingId->setRatingId(null);
            }
        }

        return $this;
    }
}
