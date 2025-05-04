<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Post;
use App\Repository\AppCommunityRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: AppCommunityRepository::class)]
#[ApiResource (operations : [
    new Get(
        normalizationContext: ['groups' => ['community:get']],
        uriTemplate: "/community/{id}",
    ),
    new Delete(
        security: "is_granted('ROLE_ADMIN')",
        securityMessage: "Vous ne pouvez supprimer une communauté que si vous êtes administrateur.",
        denormalizationContext: ['groups' => ['community:delete']],
        uriTemplate :"/community/{id}",
    ),
    new Post(
        security: "is_granted('ROLE_USER')",
        securityMessage : "Vous ne pouvez pas créer de communauté si vous n'êtes pas connecté.",
        denormalizationContext: ['groups' => ['community:create']],
        uriTemplate :"/community",
    )
])]
class AppCommunity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['community:get', 'communtiy:delete'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['community:create', 'community:get'])]
    private ?string $title = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }
}
