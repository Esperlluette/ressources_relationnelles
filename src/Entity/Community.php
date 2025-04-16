<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Post;
use App\Repository\CommunityRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommunityRepository::class)]
#[ApiResource (operations: [
    new Get(
        normalizationContext: ['groups' => ['public']],
        uriTemplate:'/community/{id}',
    ),
    new Post(
        denormalizationContext: ['groups' => ['community:create']],
        uriTemplate:"/community/create",
    ),
])]
class Community
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'communities')]
    #[ORM\JoinColumn(nullable: false)]
    private ?AppUser $user_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
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

    public function getUserId(): ?AppUser
    {
        return $this->user_id;
    }

    public function setUserId(?AppUser $user_id): static
    {
        $this->user_id = $user_id;

        return $this;
    }
}
