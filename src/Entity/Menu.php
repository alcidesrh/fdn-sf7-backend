<?php

namespace App\Entity;

use ApiPlatform\Doctrine\Common\Filter\SearchFilterInterface;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GraphQl\DeleteMutation;
use ApiPlatform\Metadata\GraphQl\Mutation;
use ApiPlatform\Metadata\GraphQl\Query;
use ApiPlatform\Metadata\GraphQl\QueryCollection;
use App\Attribute\CollectionMetadataAttribute;
use App\Attribute\FormMetadataAttribute;
use App\Entity\Base\Base;
use App\Entity\Base\Traits\StatusTrait;
use App\Repository\MenuRepository;
use App\Resolver\MenuResolver;
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
            filters: ['order.filter', 'menu.filter'],
            extraArgs: ['tipo' => ['type' => 'String', 'default' => 'root']],
        ),
        new Query(
            name: 'get',
            resolver: MenuResolver::class,
            args: ['params' => ['type' => 'Iterable']],
        ),
    ]
)]
#[ApiFilter(SearchFilter::class, alias: 'menu.filter',  properties: ['tipo' => SearchFilterInterface::STRATEGY_EXACT])]
#[CollectionMetadataAttribute(
    class: 'columns-wraper',
    props: [
        ['name' => 'id', 'class' => ' small-column'],
        ['name' => 'icon', 'class' => ' small-column'],
        ['name' => 'nombre', 'class' => 'columns-wraper'],
        ['name' => 'posicion'],
        ['name' => 'tipo'],
        ['name' => 'status'],
        ['name' => 'parent', 'label' => 'Padre'],
        ['name' => 'children', 'label' => 'Hijos'],
    ]
)]
class Menu extends Base {
    use StatusTrait;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $posicion = null;

    #[FormMetadataAttribute(merge: ['$formkit' => 'select_primevue', 'options' => '$types'])]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $tipo = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nombre = null;

    #[FormMetadataAttribute(merge: ['$formkit' => 'iconinput_primevue', 'icon' => '$icon'])]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $icon = null;

    #[FormMetadataAttribute(merge: ['options' => '$parent', 'label' => 'Padre'])]
    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'children')]
    #[ORM\JoinColumn(nullable: true, onDelete: 'SET NULL')]
    private ?self $parent = null;

    /**
     * @var Collection<int, self>
     */
    #[FormMetadataAttribute(merge: ['options' => '$children', 'label' => 'hijos'])]
    #[ORM\OneToMany(targetEntity: self::class, mappedBy: 'parent')]
    private ?Collection $children;

    #[FormMetadataAttribute(merge: ['options' => '$actions', 'label' => 'Accion'])]
    #[ORM\ManyToOne]
    private ?Action $action = null;


    public function __construct() {
        $this->children = new ArrayCollection();
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

    public function getLabel() {
        try {
            return $this->getNombre() ?? \get_class($this);
        } catch (\Throwable $th) {
            try {
                return $this->getName();
            } catch (\Throwable $th) {
                try {
                    return $this->getId();
                } catch (\Throwable $th) {
                    try {
                        return \get_class($this);
                    } catch (\Throwable $th) {
                        throw $th;
                    }
                }
            }
        }
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

    public function getIcon(): ?string {
        return $this->icon;
    }

    public function setIcon(?string $icon): static {
        $this->icon = $icon;

        return $this;
    }

    public function getAction(): ?Action {
        return $this->action;
    }

    public function setAction(?Action $action): static {
        $this->action = $action;

        return $this;
    }
}
