<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GraphQl\DeleteMutation;
use ApiPlatform\Metadata\GraphQl\Mutation;
use ApiPlatform\Metadata\GraphQl\Query;
use ApiPlatform\Metadata\GraphQl\QueryCollection;
use App\Entity\Base\TimeLegacyStatusBase;
use App\Entity\Base\Traits\ContactoTrait;
use App\Repository\EmpresaRepository;
use Doctrine\ORM\Mapping as ORM;

trait Omitir {
    protected ?Localidad $localidad = null;
}
#[ORM\Entity(repositoryClass: EmpresaRepository::class)]
#[ApiResource(
    graphQlOperations: [
        new Query(),
        new Mutation(name: 'create'),
        new Mutation(name: 'update'),
        new DeleteMutation(name: 'delete'),
        new QueryCollection(
            paginationType: 'page',
            // filters: ['or.filter', 'order.filter2'],
            // filters: ['or.filter', 'date.filter', 'order.filter'],
            // extraArgs: ['fullName' => ['type' => 'String']]
        ),
    ]
)]
class Empresa extends TimeLegacyStatusBase {
    use ContactoTrait, Omitir;
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nombreComercial = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $denominacionSocial = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $alias = null;

    public function getNombreComercial(): ?string {
        return $this->nombreComercial;
    }

    public function setNombreComercial(?string $nombreComercial): static {
        $this->nombreComercial = $nombreComercial;

        return $this;
    }

    public function getDenominacionSocial(): ?string {
        return $this->denominacionSocial;
    }

    public function setDenominacionSocial(?string $denominacionSocial): static {
        $this->denominacionSocial = $denominacionSocial;

        return $this;
    }

    public function getAlias(): ?string {
        return $this->alias;
    }

    public function setAlias(?string $alias): static {
        $this->alias = $alias;

        return $this;
    }
}
