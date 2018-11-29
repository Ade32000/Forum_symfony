<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User
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
    private $userName;

    /**
     * @ORM\Column(type="datetime")
     */
    private $UserRegisterDate;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Comment", mappedBy="fkUser", orphanRemoval=true)
     */
    private $UserComments;

    public function __construct()
    {
        $this->UserComments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserName(): ?string
    {
        return $this->userName;
    }

    public function setUserName(string $userName): self
    {
        $this->userName = $userName;

        return $this;
    }

    public function getUserRegisterDate(): ?\DateTimeInterface
    {
        return $this->UserRegisterDate;
    }

    public function setUserRegisterDate(\DateTimeInterface $UserRegisterDate): self
    {
        $this->UserRegisterDate = $UserRegisterDate;

        return $this;
    }

    /**
     * @return Collection|Comment[]
     */
    public function getUserComments(): Collection
    {
        return $this->UserComments;
    }

    public function addUserComment(Comment $userComment): self
    {
        if (!$this->UserComments->contains($userComment)) {
            $this->UserComments[] = $userComment;
            $userComment->setFkUser($this);
        }

        return $this;
    }

    public function removeUserComment(Comment $userComment): self
    {
        if ($this->UserComments->contains($userComment)) {
            $this->UserComments->removeElement($userComment);
            // set the owning side to null (unless already changed)
            if ($userComment->getFkUser() === $this) {
                $userComment->setFkUser(null);
            }
        }

        return $this;
    }
}
