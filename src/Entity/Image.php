<?php

namespace App\Entity;

use DateTimeImmutable;
use Symfony\Component\Validator\Constraints as Assert;

class Image
{
    #[Assert\NotBlank(message: 'Le titre est obligatoire.')]
    #[Assert\Length(min: 3, max: 120, minMessage: 'Le titre doit faire au moins {{ limit }} caractères.', maxMessage: 'Le titre ne peut pas dépasser {{ limit }} caractères.')]
    private ?string $titre = null;

    #[Assert\NotBlank(message: 'Le fichier image est obligatoire.')]
    #[Assert\File(mimeTypes: ['image/png', 'image/jpeg', 'image/webp'], mimeTypesMessage: 'Merci de fournir un png/jpeg/webp valide.')]
    private ?string $file = null;

    #[Assert\NotBlank(message: 'Le texte alternatif est obligatoire.')]
    #[Assert\Length(max: 150, maxMessage: 'Le texte alternatif ne peut pas dépasser {{ limit }} caractères.')]
    private ?string $alt = null;

    #[Assert\Length(max: 500, maxMessage: 'La description ne peut pas dépasser {{ limit }} caractères.')]
    private ?string $description = null;

    #[Assert\NotNull(message: 'La date de publication est obligatoire.')]
    #[Assert\LessThanOrEqual('today', message: 'La date de publication ne peut pas être dans le futur.')]
    private ?DateTimeImmutable $publishedAt = null;

    public function __construct()
    {
        $this->publishedAt = new DateTimeImmutable();
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(?string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getFile(): ?string
    {
        return $this->file;
    }

    public function setFile(?string $file): self
    {
        $this->file = $file;

        return $this;
    }

    public function getAlt(): ?string
    {
        return $this->alt;
    }

    public function setAlt(?string $alt): self
    {
        $this->alt = $alt;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPublishedAt(): ?DateTimeImmutable
    {
        return $this->publishedAt;
    }

    public function setPublishedAt(?DateTimeImmutable $publishedAt): self
    {
        $this->publishedAt = $publishedAt;

        return $this;
    }
}

