<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VisitorsRepository")
 */
class Visitors
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Prix", mappedBy="visitor")
     */
    private $prices;

    public function __construct()
    {
        $this->prices = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection|Prix[]
     */
    public function getPrices(): Collection
    {
        return $this->prices;
    }

    public function addPrice(Prix $price): self
    {
        if (!$this->prices->contains($price)) {
            $this->prices[] = $price;
            $price->setVisitor($this);
        }

        return $this;
    }

    public function removePrice(Prix $price): self
    {
        if ($this->prices->contains($price)) {
            $this->prices->removeElement($price);
            // set the owning side to null (unless already changed)
            if ($price->getVisitor() === $this) {
                $price->setVisitor(null);
            }
        }

        return $this;
    }
}
