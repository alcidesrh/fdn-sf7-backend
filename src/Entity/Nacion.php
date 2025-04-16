<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GraphQl\DeleteMutation;
use ApiPlatform\Metadata\GraphQl\Mutation;
use ApiPlatform\Metadata\GraphQl\Query;
use ApiPlatform\Metadata\GraphQl\QueryCollection;
use App\Entity\Base\Base;
use App\Repository\NacionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NacionRepository::class)]
#[ORM\Table(name: 'pais')]

#[ApiResource(
    graphQlOperations: [
        new Query(),
        new Mutation(name: 'create'),
        new Mutation(name: 'update'),
        new DeleteMutation(name: 'delete'),
        // new QueryCollection(),
        new QueryCollection(
            // name: 'collection',
            paginationType: 'page',
            // filters: ['order.filter'],
        )
    ]
)]
class Nacion extends Base {

    #[ORM\Column(length: 255)]
    private ?string $nombre = null;

    public function getNombre(): ?string {
        return $this->nombre;
    }

    public function setNombre(string $nombre): static {
        $this->nombre = $nombre;

        return $this;
    }
}
