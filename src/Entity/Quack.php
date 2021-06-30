<?php

namespace App\Entity;

use App\Repository\QuackRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=QuackRepository::class)
 * @ORM\Table(name="quack", indexes={@ORM\Index(columns={"content"}, flags={"fulltext"})})
 */
class Quack
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\ManyToOne(targetEntity=Duck::class, inversedBy="Quack")
     * @ORM\JoinColumn(nullable=true)
     */
    private $duck;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @ORM\ManyToOne(targetEntity=Quack::class, inversedBy="children")
     * @ORM\JoinColumn(name="parent_id", nullable=true)
     */
    private $parent;
    /**
     * @ORM\OneToMany(targetEntity=Quack::class, mappedBy="parent")
     */
    private $children;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getDuck(): ?Duck
    {
        return $this->duck;
    }

    public function setDuck(?Duck $duck): self
    {
        $this->duck = $duck;

        return $this;
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

    public function setChildren(Quack $quack): Quack
    {
        $this->children = $quack;
        return $this;
    }

    public function getChildren()
    {
        return $this->children;
    }

    public function setParent(Quack $quack): self
    {
        $this->parent = $quack;
        return $this;
    }

    public function getParent(): ?Quack
    {
        return $this->parent;
    }
}
