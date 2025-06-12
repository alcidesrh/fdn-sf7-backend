<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GraphQl\DeleteMutation;
use ApiPlatform\Metadata\GraphQl\Mutation;
use ApiPlatform\Metadata\GraphQl\Query;
use ApiPlatform\Metadata\GraphQl\QueryCollection;
use App\Attribute\FormkitDataReference;
use App\Entity\Base\Base;
use App\Repository\RoleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RoleRepository::class)]
#[ApiResource(
    graphQlOperations: [
        new Query(),
        new Mutation(name: 'create'),
        new Mutation(name: 'update'),
        new DeleteMutation(name: 'delete'),
        new QueryCollection(
            paginationType: 'page',
            filters: ['order.filter'],
        )
    ]
)]

class Role extends Base {


    #[ORM\Column(length: 255)]
    private ?string $nombre = null;

    /**
     * @var Collection<int, self>
     */
    #[FormkitDataReference('$parents')]
    #[ORM\ManyToMany(targetEntity: self::class, inversedBy: 'children')]
    private ?Collection $parents;

    /**
     * @var Collection<int, self>
     */
    #[FormkitDataReference('$children')]
    #[ORM\ManyToMany(targetEntity: self::class, mappedBy: 'parents')]
    private ?Collection $children;

    /**
     * @var Collection<int, Permiso>
     */
    #[FormkitDataReference('$permisos')]
    #[ORM\ManyToMany(targetEntity: Permiso::class, mappedBy: 'roles')]
    private ?Collection $permisos;

    /**
     * @var Collection<int, Action>
     */
    #[ORM\ManyToMany(targetEntity: Action::class, mappedBy: 'roles')]
    private Collection $actions;

    public function __construct() {
        $this->parents = new ArrayCollection();
        $this->children = new ArrayCollection();
        $this->permisos = new ArrayCollection();
        $this->actions = new ArrayCollection();
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function getNombre(): ?string {
        return $this->nombre;
    }

    public function setNombre(string $nombre): static {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getParents(): Collection {
        return $this->parents;
    }

    public function addParent(self $parent): static {
        if (!$this->parents->contains($parent)) {
            $this->parents->add($parent);
        }

        return $this;
    }

    public function removeParent(self $parent): static {
        $this->parents->removeElement($parent);

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getChildren(): Collection {
        return $this->children;
    }

    public function addChild(self $child): static {
        if (!$this->children->contains($child)) {
            $this->children->add($child);
            $child->addParent($this);
        }

        return $this;
    }

    public function removeChild(self $child): static {
        if ($this->children->removeElement($child)) {
            $child->removeParent($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Permiso>
     */
    public function getPermisos(): Collection {
        return $this->permisos;
    }

    public function addPermiso(Permiso $permiso): static {
        if (!$this->permisos->contains($permiso)) {
            $this->permisos->add($permiso);
            $permiso->addRole($this);
        }

        return $this;
    }

    public function removePermiso(Permiso $permiso): static {
        if ($this->permisos->removeElement($permiso)) {
            $permiso->removeRole($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Action>
     */
    public function getActions(): Collection
    {
        return $this->actions;
    }

    public function addAction(Action $action): static
    {
        if (!$this->actions->contains($action)) {
            $this->actions->add($action);
            $action->addRole($this);
        }

        return $this;
    }

    public function removeAction(Action $action): static
    {
        if ($this->actions->removeElement($action)) {
            $action->removeRole($this);
        }

        return $this;
    }
}
