<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommentRepository")
 */
class Comment
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
    private $CommentTitle;

    /**
     * @ORM\Column(type="text")
     */
    private $CommentContent;

    /**
     * @ORM\Column(type="datetime")
     */
    private $CommentDate;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="UserComments")
     * @ORM\JoinColumn(nullable=false)
     */
    private $fkUser;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="categoryComments")
     * @ORM\JoinColumn(nullable=false)
     */
    private $fkCategory;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Comment", inversedBy="fkComment")
     */
    private $SubComment;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Comment", mappedBy="SubComment")
     */
    private $fkComment;

    public function __construct()
    {
        $this->fkComment = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCommentTitle(): ?string
    {
        return $this->CommentTitle;
    }

    public function setCommentTitle(string $CommentTitle): self
    {
        $this->CommentTitle = $CommentTitle;

        return $this;
    }

    public function getCommentContent(): ?string
    {
        return $this->CommentContent;
    }

    public function setCommentContent(string $CommentContent): self
    {
        $this->CommentContent = $CommentContent;

        return $this;
    }

    public function getCommentDate(): ?\DateTimeInterface
    {
        return $this->CommentDate;
    }

    public function setCommentDate(\DateTimeInterface $CommentDate): self
    {
        $this->CommentDate = $CommentDate;

        return $this;
    }

    public function getFkUser(): ?User
    {
        return $this->fkUser;
    }

    public function setFkUser(?User $fkUser): self
    {
        $this->fkUser = $fkUser;

        return $this;
    }

    public function getFkCategory(): ?Category
    {
        return $this->fkCategory;
    }

    public function setFkCategory(?Category $fkCategory): self
    {
        $this->fkCategory = $fkCategory;

        return $this;
    }

    public function getSubComment(): ?self
    {
        return $this->SubComment;
    }

    public function setSubComment(?self $SubComment): self
    {
        $this->SubComment = $SubComment;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getFkComment(): Collection
    {
        return $this->fkComment;
    }

    public function addFkComment(self $fkComment): self
    {
        if (!$this->fkComment->contains($fkComment)) {
            $this->fkComment[] = $fkComment;
            $fkComment->setSubComment($this);
        }

        return $this;
    }

    public function removeFkComment(self $fkComment): self
    {
        if ($this->fkComment->contains($fkComment)) {
            $this->fkComment->removeElement($fkComment);
            // set the owning side to null (unless already changed)
            if ($fkComment->getSubComment() === $this) {
                $fkComment->setSubComment(null);
            }
        }

        return $this;
    }
}
