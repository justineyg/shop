<?php

namespace App\Entity;

use App\Repository\CartRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CartRepository::class)]
class Cart
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'carts')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $purchaseDate = null;

    #[ORM\Column]
    private ?bool $status = null;

    #[ORM\OneToMany(mappedBy: 'cart', targetEntity: ContentCart::class)]
    private Collection $contentCarts;

    public function __construct()
    {
        $this->contentCarts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getPurchaseDate(): ?\DateTimeInterface
    {
        return $this->purchaseDate;
    }

    public function setPurchaseDate(\DateTimeInterface $purchaseDate): self
    {
        $this->purchaseDate = $purchaseDate;

        return $this;
    }

    public function isStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return Collection<int, ContentCart>
     */
    public function getContentCarts(): Collection
    {
        return $this->contentCarts;
    }

    public function addContentCart(ContentCart $contentCart): self
    {
        if (!$this->contentCarts->contains($contentCart)) {
            $this->contentCarts->add($contentCart);
            $contentCart->setCart($this);
        }

        return $this;
    }

    public function removeContentCart(ContentCart $contentCart): self
    {
        if ($this->contentCarts->removeElement($contentCart)) {
            // set the owning side to null (unless already changed)
            if ($contentCart->getCart() === $this) {
                $contentCart->setCart(null);
            }
        }

        return $this;
    }
}
