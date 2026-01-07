<?php

namespace App\Entity;

use ApiPlatform\Doctrine\Orm\State\Options;
use ApiPlatform\Doctrine\Orm\Util\QueryNameGeneratorInterface;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\GraphQl\DeleteMutation;
use ApiPlatform\Metadata\GraphQl\Mutation;
use ApiPlatform\Metadata\GraphQl\Query;
use ApiPlatform\Metadata\GraphQl\QueryCollection;
use ApiPlatform\Metadata\Operation;
use App\Repository\IconCategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\QueryBuilder;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: IconCategoryRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['iconcategory:read']],
    denormalizationContext: ['groups' => ['iconcategory:write']],
    paginationEnabled: false,
    // graphQlOperations: [
    //     new Query(),
    //     new Mutation(name: 'create'),
    //     new Mutation(name: 'update'),
    //     new DeleteMutation(name: 'delete'),
    //     new QueryCollection(),
    // ]
)]
class IconCategory {

    #[Groups(['iconcategory:read', 'iconcategory:write'])]
    public ?int $totalIcons;

    #[Groups(['iconcategory:read', 'iconcategory:write'])]
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Groups(['iconcategory:read', 'iconcategory:write'])]
    #[ORM\Column(length: 255)]
    private ?string $name = null;

    /**
     * @var Collection<int, Icon>
     */
    #[Groups(['iconcategory:read', 'iconcategory:write'])]
    #[ORM\ManyToMany(targetEntity: Icon::class)]
    private Collection $icons;


    public function __construct() {
        $this->icons = new ArrayCollection();
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function getName(): ?string {
        return $this->name;
    }

    public function setName(string $name): static {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Icon>
     */
    public function getIcons(): Collection {
        return $this->icons;
    }

    public function addIcon(Icon $icon): static {
        if (!$this->icons->contains($icon)) {
            $this->icons->add($icon);
        }

        return $this;
    }

    public function removeIcon(Icon $icon): static {
        $this->icons->removeElement($icon);

        return $this;
    }
}
