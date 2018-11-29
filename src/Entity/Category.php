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
    private $categoryName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $categoryImage;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Comment", mappedBy="fkCategory")
     */
    private $categoryComments;

    public function __construct()
    {
        $this->categoryComments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategoryName(): ?string
    {
        return $this->categoryName;
    }

    public function setCategoryName(string $categoryName): self
    {
        $this->categoryName = $categoryName;

        return $this;
    }

    public function getCategoryImage(): ?string
    {
        return $this->categoryImage;
    }

    public function setCategoryImage(?string $categoryImage): self
    {
        $this->categoryImage = $categoryImage;

        return $this;
    }

    /**
     * @return Collection|Comment[]
     */
    public function getCategoryComments(): Collection
    {
        return $this->categoryComments;
    }

    public function addCategoryComment(Comment $categoryComment): self
    {
        if (!$this->categoryComments->contains($categoryComment)) {
            $this->categoryComments[] = $categoryComment;
            $categoryComment->setFkCategory($this);
        }

        return $this;
    }

    public function removeCategoryComment(Comment $categoryComment): self
    {
        if ($this->categoryComments->contains($categoryComment)) {
            $this->categoryComments->removeElement($categoryComment);
            // set the owning side to null (unless already changed)
            if ($categoryComment->getFkCategory() === $this) {
                $categoryComment->setFkCategory(null);
            }
        }

        return $this;
    }
}
