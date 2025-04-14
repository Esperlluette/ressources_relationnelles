<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Delete;
use App\Repository\PostRepository;
use Doctrine\DBAL\Types\Types;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: PostRepository::class)]
#[ApiResource(operations: [
    new Get(
        uriTemplate: "/post/{id}",
    ),
    new Patch(
        security: "object == user or is_granted('ROLE_ADMIN')",
        securityMessage : "Vous ne pouvez pas modifier le post si vous n'êtes pas administrateur.",
        uriTemplate :"/post/{id}",
    ),
    new Delete(
        security: "object == user or is_granted('ROLE_ADMIN')",
        securityMessage : "Vous ne pouvez pas supprimer le post si vous n'êtes pas administrateur.",
        uriTemplate :"/post/{id}",
    ),
    new Post(
        security: "object == user",
        securityMessage : "Vous ne pouvez pas publier le post si vous n'êtes pas connecté.",
        uriTemplate :"/post",
    )
])]

class AppPost
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups("private")]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['post:create', 'post:update'])]
    private ?string $body = null;

    #[ORM\Column(type: Types::BLOB)]
    #[Groups(['post:create', 'post:update'])]
    private $media_data = null;

    #[ORM\Column(length: 255)]
    #[Groups(['post:create', 'post:update'])]
    private ?string $media_type = null;

    //#[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?AppUser $id_appUser = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_created = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBody(): ?string
    {
        return $this->body;
    }

    public function setBody(?string $body): static
    {
        $this->body = $body;

        return $this;
    }

    public function getMediaData()
    {
        return $this->media_data;
    }

    public function setMediaData($media_data): static
    {
        $this->media_data = $media_data;

        return $this;
    }

    public function getMediaType(): ?string
    {
        return $this->media_type;
    }

    public function setMediaType(string $media_type): static
    {
        $this->media_type = $media_type;

        return $this;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getIdAppUser(): ?AppUser
    {
        return $this->id_appUser;
    }

    public function setIdAppUser(AppUser $id_appUser): static
    {
        $this->id_appUser = $id_appUser;

        return $this;
    }

    public function getDateCreated(): ?\DateTimeInterface
    {
        return $this->date_created;
    }

    public function setDateCreated(\DateTimeInterface $date_created): static
    {
        $this->date_created = $date_created;

        return $this;
    }
}
