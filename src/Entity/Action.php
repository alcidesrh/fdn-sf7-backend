<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GraphQl\DeleteMutation;
use ApiPlatform\Metadata\GraphQl\Mutation;
use ApiPlatform\Metadata\GraphQl\Query;
use ApiPlatform\Metadata\GraphQl\QueryCollection;
use App\Attribute\CollectionMetadataAttribute;
use App\Attribute\FormMetadataAttribute;
use App\Entity\Base\Base;
use App\Entity\Base\Traits\StatusTrait;
use App\Repository\ActionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ActionRepository::class)]
#[ApiResource(
    graphQlOperations: [
        new Query(),
        new Mutation(name: 'create'),
        new Mutation(name: 'update'),
        new DeleteMutation(name: 'delete'),
        new QueryCollection(
            paginationType: 'page',
            filters: ['order.filter'],
        ),
    ]
)]
#[FormMetadataAttribute(order: ['icon', 'status', 'nota', 'nombre', 'ruta'], columns: 2)]
#[CollectionMetadataAttribute(
    class: 'columns-wraper',
    props: [
        ['name' => 'id', 'class' => ' small-column'],
        ['name' => 'icon', 'class' => ' small-column'],
        ['name' => 'nombre', 'class' => 'columns-wraper'],
        ['name' => 'ruta']
    ]
)]
class Action extends Base {

    use StatusTrait;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $ruta = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $icon = null;


    #[ORM\Column(length: 255, nullable: true)]
    protected ?string $nombre = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    protected ?string $nota = null;


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
    public function getNota(): ?string {
        return $this->nota;
    }

    public function setNota(string $nota): static {
        $this->nota = $nota;

        return $this;
    }



    public function getRuta(): ?string {
        return $this->ruta;
    }

    public function setRuta(?string $ruta): static {
        $this->ruta = $ruta;

        return $this;
    }

    public function getIcon(): ?string {
        return $this->icon;
    }

    public function setIcon(?string $icon): static {
        $this->icon = $icon;

        return $this;
    }
}
