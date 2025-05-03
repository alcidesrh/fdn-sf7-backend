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
use App\Attribute\CollectionMetadataAttribute;
use App\Entity\Base\TimeLegacyStatusBase;
use App\Entity\Base\Traits\StatusTrait;
use App\Filter\OrFilter;
use App\Repository\BusRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BusRepository::class)]
#[ApiResource(
    graphQlOperations: [
        new Query(),
        // new Mutation(name: 'create'),
        // new Mutation(name: 'update'),
        // new DeleteMutation(name: 'delete'),
        new QueryCollection(
            paginationType: 'page',
            filters: ['bus.or.filter', 'bus.date.filter', 'bus.order.filter'],
        ),
    ]
)]

#[ApiFilter(OrFilter::class, alias: 'bus.or.filter', properties: ['id', 'marca', 'placa', 'status'], arguments: ['searchFilterProperties' => ['id' => SearchFilterInterface::STRATEGY_EXACT, 'placa' => SearchFilterInterface::STRATEGY_IPARTIAL, 'marca' => SearchFilterInterface::STRATEGY_IPARTIAL, 'status' => SearchFilterInterface::STRATEGY_EXACT, 'createdAt' => DateFilterInterface::EXCLUDE_NULL]])]

#[ApiFilter(DateFilter::class, alias: 'bus.date.filter', properties: ['createdAt' => DateFilterInterface::EXCLUDE_NULL])]

#[ApiFilter(OrderFilter::class, alias: 'bus.order.filter', properties: ['id', 'marca', 'placa', 'createdAt', 'status'], arguments: ['orderParameterName' => 'order'])]

#[CollectionMetadataAttribute(properties: [
    ['name' => 'id', 'label' => 'Id', 'sort' => true, 'filter' => true],
    ['name' => 'marca', 'label' => 'Marca', 'sort' => true, 'filter' => true],
    ['name' => 'createdAt', 'label' => 'Fecha creación', 'sort' => 'fecha', 'filter' => true],
    ['name' => 'placa', 'label' => 'Placa', 'sort' => 'status', 'filter' => true],
    ['name' => 'status', 'label' => 'Status', 'sort' => 'status'],

])]
class Bus extends TimeLegacyStatusBase {

    use StatusTrait;

    #[ORM\Column(length: 15, nullable: true)]
    private ?string $codigo = null;

    #[ORM\OneToMany(mappedBy: 'bus', targetEntity: Asiento::class, orphanRemoval: true)]
    private Collection $asientos;

    #[ORM\Column(nullable: true)]
    private ?float $precioVariacionAsientoA = null;

    #[ORM\Column(nullable: true)]
    private ?float $precioVariacionAsientoB = null;

    #[ORM\ManyToOne]
    private ?Empresa $empresa = null;

    #[ORM\ManyToOne(cascade: ['persist'])]
    private ?Piloto $piloto = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $marca = null;

    #[ORM\Column(length: 25, nullable: true)]
    private ?string $placa = null;

    public function __construct() {
        $this->asientos = new ArrayCollection();
    }

    public function getId(): ?int {
        return $this->id;
    }


    public function getCodigo(): ?string {
        return $this->codigo;
    }

    public function setCodigo(?string $codigo): static {
        $this->codigo = $codigo;

        return $this;
    }

    /**
     * @return Collection<int, Asiento>
     */
    public function getAsientos(): Collection {
        return $this->asientos;
    }

    public function addAsiento(Asiento $asiento): static {
        if (!$this->asientos->contains($asiento)) {
            $this->asientos->add($asiento);
            $asiento->setBus($this);
        }

        return $this;
    }

    public function removeAsiento(Asiento $asiento): static {
        if ($this->asientos->removeElement($asiento)) {
            // set the owning side to null (unless already changed)
            if ($asiento->getBus() === $this) {
                $asiento->setBus(null);
            }
        }

        return $this;
    }

    public function getPrecioVariacionAsientoA(): ?float {
        return $this->precioVariacionAsientoA;
    }

    public function setPrecioVariacionAsientoA(?float $precioVariacionAsientoA): static {
        $this->precioVariacionAsientoA = $precioVariacionAsientoA;

        return $this;
    }

    public function getPrecioVariacionAsientoB(): ?float {
        return $this->precioVariacionAsientoB;
    }

    public function setPrecioVariacionAsientoB(?float $precioVariacionAsientoB): static {
        $this->precioVariacionAsientoB = $precioVariacionAsientoB;

        return $this;
    }

    public function getEmpresa(): ?Empresa {
        return $this->empresa;
    }

    public function setEmpresa(?Empresa $empresa): static {
        $this->empresa = $empresa;

        return $this;
    }

    public function getPiloto(): ?Piloto {
        return $this->piloto;
    }

    public function setPiloto(?Piloto $piloto): static {
        $this->piloto = $piloto;

        return $this;
    }

    public function getMarca(): ?string {
        return $this->marca;
    }

    public function setMarca(?string $marca): static {
        $this->marca = $marca;

        return $this;
    }

    public function getPlaca(): ?string {
        return $this->placa;
    }

    public function setPlaca(?string $placa): static {
        $this->placa = $placa;

        return $this;
    }
}
