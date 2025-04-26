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
use App\Attribute\ColumnTableList;
use App\Attribute\FormkitDataReference;
use App\Attribute\FormkitLabel;
use App\Entity\Base\Base;
use App\Filter\OrFilter;
use App\Repository\LocalidadRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LocalidadRepository::class)]
#[ApiResource(
    graphQlOperations: [
        new Query(),
        new Mutation(name: 'create'),
        new Mutation(name: 'update'),
        new DeleteMutation(name: 'delete'),
        new QueryCollection(
            paginationType: 'page',
            filters: ['or.filter',  'order.filter']
        )
    ]
)]

#[ApiFilter(OrFilter::class, alias: 'or.filter', properties: ['id', 'nombre'], arguments: ['searchFilterProperties' => ['id' => SearchFilterInterface::STRATEGY_EXACT,  'nombre' => SearchFilterInterface::STRATEGY_IPARTIAL]])]

#[ApiFilter(OrderFilter::class, alias: 'order.filter', properties: ['id'], arguments: ['orderParameterName' => 'order'])]

#[ColumnTableList(properties: [
    'classes' => 'columns-wraper',
    ['name' => 'id', 'label' => 'Id', 'sort' => true, 'filter' => true,],
    ['name' => 'nombre', 'label' => 'Nombre', 'sort' => true, 'filter' => true],
    ['name' => 'nacion', 'label' => 'Pais', 'sort' => false],
])]

class Localidad extends Base {

    #[ORM\Column(length: 255)]
    private ?string $nombre = null;

    #[FormkitLabel('pais')]
    #[FormkitDataReference('$naciones')]
    #[ORM\ManyToOne]
    private ?Nacion $nacion = null;

    public function getNombre(): ?string {
        return $this->nombre;
    }

    public function setNombre(string $nombre): static {
        $this->nombre = $nombre;

        return $this;
    }

    public function getNacion(): ?Nacion {
        return $this->nacion;
    }

    public function setNacion(?Nacion $nacion): static {
        $this->nacion = $nacion;

        return $this;
    }
}
