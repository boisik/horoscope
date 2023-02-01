<?php

namespace App\Entity;

use App\Repository\VerseRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VerseRepository::class)]
class Verse
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private $id ;

    #[ORM\Column(nullable: true)]
    private ?int $numberChapter = null;

    #[ORM\ManyToOne(targetEntity: Book::class, inversedBy: 'verse')]
    private $book;

    public function getBook(): ?Book
    {
        return $this->book;
    }

    public function setBook(?Book $book): self
    {
        $this->book = $book;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumberChapter(): ?int
    {
        return $this->numberChapter;
    }


    public function setNumberChapter(?int $numberChapter): self
    {
        $this->numberChapter = $numberChapter;

        return $this;
    }

}
