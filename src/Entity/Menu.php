<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GraphQl\DeleteMutation;
use ApiPlatform\Metadata\GraphQl\Mutation;
use ApiPlatform\Metadata\GraphQl\Query;
use ApiPlatform\Metadata\GraphQl\QueryCollection;
use App\Attribute\AttributeUtil;
use App\Attribute\ColumnTableList;
use App\Attribute\ExcludeAttribute;
use App\Attribute\PropertyOrder;
use App\Attribute\FormKitDataReference;
use App\Attribute\FormkitLabel;
use App\Attribute\FormkitSchema;
use App\Attribute\FormKitType;
use App\Entity\Base\Base;
use App\Entity\Base\Traits\StatusTrait;
use App\Repository\MenuRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MenuRepository::class)]
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

// #[FormkitSchema("nombre", "link", "posicion", "status", 'parent', 'children')]
#[PropertyOrder('nombre', 'parent', 'children', 'link')]
#[ColumnTableList(properties: [
    'classes' => 'columns-wraper',
    ['name' => 'id', 'class' => ' small-column'],
    ['name' => 'nombre', 'class' => 'columns-wraper'],
    ['name' => 'posicion'],
    ['name' => 'tipo'],
    ['name' => 'status'],
    ['name' => 'parent', 'label' => 'Padre'],
    ['name' => 'children', 'label' => 'Hijos'],
])]
class Menu extends Base {
    use StatusTrait;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $link = null;


    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $posicion = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $tipo = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nombre = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $nota = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $icon = null;
    /**
     * @var Collection<int, Role>
     */
    #[ORM\ManyToMany(targetEntity: Role::class)]
    private Collection $roles;

    /**
     * @var Collection<int, Permiso>
     */
    #[ORM\ManyToMany(targetEntity: Permiso::class)]
    private Collection $permisos;

    #[FormKitDataReference('$parent')]
    #[FormkitLabel('Padre')]
    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'children')]
    #[ORM\JoinColumn(nullable: true, onDelete: 'SET NULL')]
    private ?self $parent = null;

    /**
     * @var Collection<int, self>
     */
    #[FormkitLabel('hijos')]
    #[FormKitDataReference('$children')]
    #[ORM\OneToMany(targetEntity: self::class, mappedBy: 'parent')]
    private ?Collection $children;



    /**
     * @var Collection<int, User>
     */
    #[FormkitLabel('Usuarios')]
    #[ORM\ManyToMany(targetEntity: User::class)]
    private Collection $allowUsers;


    /**
     * @var Collection<int, User>
     */
    #[ORM\JoinTable(name: 'menu_deny_user')]
    #[ORM\ManyToMany(targetEntity: User::class)]
    private Collection $denyUsers;

    public function __construct() {
        $this->children = new ArrayCollection();
        $this->roles = new ArrayCollection();
        $this->allowUsers = new ArrayCollection();
        $this->permisos = new ArrayCollection();
        $this->denyUsers = new ArrayCollection();
    }

    public function getLink(): ?string {
        return $this->link;
    }

    public function setLink(?string $link): static {
        $this->link = $link;

        return $this;
    }

    public function getTipo(): ?string {
        return $this->tipo;
    }

    public function setTipo(?string $tipo): static {
        $this->tipo = $tipo;

        return $this;
    }

    public function getPosicion(): ?int {
        return $this->posicion;
    }

    public function setPosicion(?int $posicion): static {
        $this->posicion = $posicion;

        return $this;
    }

    public function getNombre(): ?string {
        return $this->nombre;
    }
    public function setNombre(string $nombre): static {
        $this->nombre = $nombre;

        return $this;
    }
    public function getNota(): ?string {
        return $this->nota;
    }

    public function setNota(?string $nota): static {
        $this->nota = $nota;

        return $this;
    }

    public function getLabel() {

        $class = \get_class($this);
        $info = AttributeUtil::getExtractor();
        $properties = $info->getProperties($class);
        if (!empty(\array_intersect($properties, ['nombre', 'name']))) {
            try {
                return $this->getNombre();
            } catch (\Throwable $th) {
                try {
                    return $this->getName();
                } catch (\Throwable $th) {
                    throw $th;
                }
            }
        }
        return $this->getId();
    }
    public function __toString() {

        return $this->getLabel();
    }

    public function getParent(): ?self {
        return $this->parent;
    }

    public function setParent(?self $parent): static {
        $this->parent = $parent;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getChildren(): array {
        return $this->children->getValues();
    }

    public function addChild(self $child): static {
        if (!$this->children->contains($child)) {
            $this->children->add($child);
            $child->setParent($this);
        }

        return $this;
    }

    public function removeChild(self $child): static {
        if ($this->children->removeElement($child)) {
            // set the owning side to null (unless already changed)
            if ($child->getParent() === $this) {
                $child->setParent(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Role>
     */
    public function getRoles(): Collection {
        return $this->roles;
    }

    public function addRole(Role $role): static {
        if (!$this->roles->contains($role)) {
            $this->roles->add($role);
        }

        return $this;
    }

    public function removeRole(Role $role): static {
        $this->roles->removeElement($role);

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getAllowUsers(): Collection {
        return $this->allowUsers;
    }

    public function addAllowUser(User $allowUser): static {
        if (!$this->allowUsers->contains($allowUser)) {
            $this->allowUsers->add($allowUser);
        }

        return $this;
    }

    public function removeAllowUser(User $allowUser): static {
        $this->allowUsers->removeElement($allowUser);

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
        }

        return $this;
    }

    public function removePermiso(Permiso $permiso): static {
        $this->permisos->removeElement($permiso);

        return $this;
    }

    public function getIcon(): ?string {
        return $this->icon;
    }

    public function setIcon(?string $icon): static {
        $this->icon = $icon;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getDenyUsers(): Collection {
        return $this->denyUsers;
    }

    public function addDenyUser(User $denyUser): static {
        if (!$this->denyUsers->contains($denyUser)) {
            $this->denyUsers->add($denyUser);
        }

        return $this;
    }

    public function removeDenyUser(User $denyUser): static {
        $this->denyUsers->removeElement($denyUser);

        return $this;
    }
}
