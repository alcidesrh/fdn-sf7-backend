<?php

namespace App\Entity;

use ApiPlatform\Doctrine\Common\Filter\SearchFilterInterface;
use ApiPlatform\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GraphQl\DeleteMutation;
use ApiPlatform\Metadata\GraphQl\Mutation;
use ApiPlatform\Metadata\GraphQl\Query;
use ApiPlatform\Metadata\GraphQl\QueryCollection;
use App\Attribute\CollectionMetadataAttribute;
use App\Entity\Base\Traits\LegacyTrait;
use App\Entity\Base\Traits\SluggableTrait;
use App\Filter\OrFilter;
use App\Repository\EstacionRepository;
use App\Resolver\FindByFindOneByFieldResolver;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EstacionRepository::class)]
#[ApiResource(
    graphQlOperations: [
        new Query(),
        new Mutation(name: 'create'),
        new Mutation(name: 'update'),
        new DeleteMutation(name: 'delete'),
        new QueryCollection(
            paginationType: 'page',
            filters: ['or.filter.estacion', 'order.filter.estacion'],
            // filters: ['or.filter', 'date.filter', 'order.filter'],
            // extraArgs: ['fullName' => ['type' => 'String']]
        ),
        // new Query(
        //     name: 'findByFindOneByFieldResolver',
        //     resolver: FindByFindOneByFieldResolver::class,
        //     args: [
        //         'entity' => ['type' => 'String'],
        //         'field' => ['type' => 'String'],
        //         'value' => ['type' => 'String']
        //     ],
        //     // read: false
        // ),
    ]
)]

#[ApiFilter(OrFilter::class, alias: 'or.filter.estacion', properties: ['id', 'nombre', 'alias'], arguments: ['searchFilterProperties' => ['id' => SearchFilterInterface::STRATEGY_EXACT, 'nombre' => SearchFilterInterface::STRATEGY_IPARTIAL, 'alias' => SearchFilterInterface::STRATEGY_IPARTIAL]])]

#[ApiFilter(OrderFilter::class, alias: 'order.filter.estacion', properties: ['id', 'nombre', 'alias', 'status'], arguments: ['orderParameterName' => 'order'])]

#[CollectionMetadataAttribute(properties: [
    ['name' => 'id', 'label' => 'Id', 'sort' => true, 'filter' => true],
    ['name' => 'nombre',  'sort' => true, 'filter' => true],
    ['name' => 'alias', 'sort' => true, 'filter' => true],
    ['name' => 'status',  'sort' => true,],
    ['name' => 'direccion'],
    ['name' => 'slug'],
])]

class Estacion extends Enclave {

    use LegacyTrait, SluggableTrait;

    #[ORM\ManyToMany(targetEntity: User::class)]
    private Collection $users;

    #[ORM\Column(length: 10)]
    private ?string $alias = null;

    public function __construct() {
        $this->users = new ArrayCollection();
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection {
        return $this->users;
    }

    public function addUser(User $user): static {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->setEstacion($this);
        }

        return $this;
    }

    public function removeUser(User $user): static {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getEstacion() === $this) {
                $user->setEstacion(null);
            }
        }

        return $this;
    }

    public function getAlias(): ?string {
        return $this->alias;
    }

    public function setAlias(string $alias): static {
        $this->alias = $alias;

        return $this;
    }
}
