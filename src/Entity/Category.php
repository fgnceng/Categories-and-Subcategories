<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategoryRepository")
 */
class Category
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
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Subcategory", mappedBy="category")
     */
    private $sub_categories;

    public function __construct()
    {
        $this->sub_categories = new ArrayCollection();
    }

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

    /**
     * @return Collection|Subcategory[]
     */
    public function getSubCategories(): Collection
    {
        return $this->sub_categories;
    }

    public function addSubCategory(Subcategory $subCategory): self
    {
        if (!$this->sub_categories->contains($subCategory)) {
            $this->sub_categories[] = $subCategory;
            $subCategory->setCategory($this);
        }

        return $this;
    }

    public function removeSubCategory(Subcategory $subCategory): self
    {
        if ($this->sub_categories->contains($subCategory)) {
            $this->sub_categories->removeElement($subCategory);
            // set the owning side to null (unless already changed)
            if ($subCategory->getCategory() === $this) {
                $subCategory->setCategory(null);
            }
        }

        return $this;
    }

    public function __toString() {
        return (string) $this->name; }
}
