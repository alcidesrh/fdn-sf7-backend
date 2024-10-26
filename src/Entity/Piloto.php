<?php

namespace App\Entity;

use ApiPlatform\Doctrine\Common\Filter\DateFilterInterface;
use ApiPlatform\Doctrine\Common\Filter\SearchFilterInterface;
use ApiPlatform\Doctrine\Orm\Filter\DateFilter;
use ApiPlatform\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GraphQl\Query;
use ApiPlatform\Metadata\GraphQl\QueryCollection;
use App\Attribute\ColumnTableList;
use App\Entity\Base\PersonaBase;
use App\Filter\OrFilter;
use App\Repository\PilotoRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PilotoRepository::class)]

#[ApiResource(
    graphQlOperations: [
        new Query(),
        new QueryCollection(
            paginationType: 'page',
            filters: ['piloto.filter', 'piloto.date.filter', 'piloto.order.filter'],
            extraArgs: ['fullName' => ['type' => 'String']]
        ),
    ]
)]

#[ApiFilter(OrFilter::class, alias: 'piloto.filter', properties: ['id', 'fullName', 'email', 'status', 'licencia', 'telefono'], arguments: ['searchFilterProperties' => ['id' => SearchFilterInterface::STRATEGY_EXACT, 'fullName' => SearchFilterInterface::STRATEGY_IPARTIAL, 'email' => SearchFilterInterface::STRATEGY_IPARTIAL, 'licencia' => SearchFilterInterface::STRATEGY_IPARTIAL, 'telefono' => SearchFilterInterface::STRATEGY_IPARTIAL, 'status' => SearchFilterInterface::STRATEGY_EXACT, 'createdAt' => DateFilterInterface::INCLUDE_NULL_BEFORE_AND_AFTER]])]

#[ApiFilter(DateFilter::class, alias: 'piloto.date.filter', properties: ['createdAt' => DateFilterInterface::EXCLUDE_NULL, 'fecha_nacimiento' => DateFilterInterface::EXCLUDE_NULL])]

#[ApiFilter(OrderFilter::class, alias: 'piloto.order.filter', properties: ['id', 'nombre', 'email', 'createdAt', 'status'], arguments: ['orderParameterName' => 'order'])]

#[ColumnTableList(properties: [
    ['name' => 'id', 'label' => 'Id', 'sort' => true, 'filter' => true],
    ['name' => 'fullName', 'label' => 'Nombre', 'sort' => 'nombre', 'filter' => true, 'style' => 'max-width: 200px'],
    ['name' => 'email', 'label' => 'email', 'sort' => true, 'filter' => true],
    ['name' => 'nit', 'label' => 'nit'],
    ['name' => 'telefono', 'label' => 'telefono', 'sort' => true, 'filter' => true],
    [
        'name' => 'direccion',
        'label' => 'direccion',
        'sort' => true,
        'filter' => true
    ],
    [
        'name' => 'licencia',
        'label' => 'licencia',
        'sort' => true,
        'filter' => true
    ],
    ['name' => 'fechaNacimiento', 'label' => 'fecha Nacimiento', 'sort' => 'fecha', 'filter' => true],

    ['name' => 'createdAt', 'label' => 'Fecha creación', 'sort' => 'fecha', 'filter' => true],
    ['name' => 'status', 'label' => 'Status', 'sort' => 'status'],
])]
class Piloto extends PersonaBase {

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $licencia = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $licenciaVencimiento = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $dpi = null;

    #[ORM\Column(length: 5, nullable: true)]
    private ?string $sexo = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $fechaNacimiento = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $seguroSocial = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nacionalidad = null;

    private ?string $fullName;
    public function getFullName() {
        return $this->nombre . ' ' . $this->apellido;
    }

    public function getLicencia(): ?string {
        return $this->licencia;
    }

    public function setLicencia(?string $licencia): static {
        $this->licencia = $licencia;

        return $this;
    }

    public function getlicenciaVencimiento(): ?\DateTimeInterface {
        return $this->licenciaVencimiento;
    }

    public function setLicenciaVencimiento(?\DateTimeInterface $licenciaVencimiento): static {
        $this->licenciaVencimiento = $licenciaVencimiento;

        return $this;
    }

    public function getDpi(): ?string {
        return $this->dpi;
    }

    public function setDpi(?string $dpi): static {
        $this->dpi = $dpi;

        return $this;
    }

    public function getSexo(): ?string {
        return $this->sexo;
    }

    public function setSexo(?string $sexo): static {
        $this->sexo = $sexo;

        return $this;
    }

    public function getFechaNacimiento(): ?\DateTimeInterface {
        return $this->fechaNacimiento;
    }

    public function setFechaNacimiento(?\DateTimeInterface $fechaNacimiento): static {
        $this->fechaNacimiento = $fechaNacimiento;

        return $this;
    }

    public function getSeguroSocial(): ?string {
        return $this->seguroSocial;
    }

    public function setSeguroSocial(?string $seguroSocial): static {
        $this->seguroSocial = $seguroSocial;

        return $this;
    }

    public function getNacionalidad(): ?string {
        return $this->nacionalidad;
    }

    public function setNacionalidad(?string $nacionalidad): static {
        $this->nacionalidad = $nacionalidad;

        return $this;
    }
}
