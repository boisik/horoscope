<?php

namespace App\Entity;

use App\Repository\ImportListItemRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ImportListItemRepository::class)]
class ImportListItem
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private $id ;

    #[ORM\Column(nullable: true)]
    private ?int $cheked = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $url = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCheked(): ?int
    {
        return $this->cheked;
    }


    public function setCheked(?int $cheked): self
    {
        $this->cheked = $cheked;

        return $this;
    }

    public function setUrl( $url): self
    {
        $this->url = $url;

        return $this;
    }


    public function getUrl(): ?string
    {
        return $this->url;
    }
}
