<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'Le nom ne peut pas être vide.')]
    #[Assert\Length(
        min: 3,
        minMessage: 'Le nom doit contenir au moins {{ limit }} caractères.'
    )]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $label = null;

    /**
     * @var Collection<int, Media>
     */
    #[ORM\ManyToMany(targetEntity: Media::class, mappedBy: 'categories')]
    private Collection $medias;

    public function __construct()
    {
        $this->medias = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): static
    {
        $this->label = $label;

        return $this;
    }

    /**
     * @return Collection<int, Media>
     */
    public function getMedias(): Collection
    {
        return $this->medias;
    }

    public function addMedia(Media $media): static
    {
        if (!$this->medias->contains($media)) {
            $this->medias->add($media);
            $media->addCategory($this);
        }

        return $this;
    }

    public function removeMedia(Media $media): static
    {
        if ($this->medias->removeElement($media)) {
            $media->removeCategory($this);
        }

        return $this;
    }
}
