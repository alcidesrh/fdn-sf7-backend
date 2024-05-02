<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Attribute\FormKitCreateExclude;
use App\Entity\Base\NombreNotaStatusBaseSuperClass;
use App\Repository\TaxonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TaxonRepository::class)]
#[ApiResource]
#[ORM\InheritanceType('JOINED')]
#[ORM\DiscriminatorColumn(name: 'discr', type: 'string')]
#[ORM\DiscriminatorMap(['enclave' => MenuItem::class])]
class Taxon extends NombreNotaStatusBaseSuperClass
{

    #[ORM\ManyToOne(targetEntity: self::class)]
    protected ?self $parent = null;


    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    protected ?int $posicion = null;

    /**
     * @var Collection<int, self>
     */
    #[ORM\ManyToMany(targetEntity: self::class)]
    #[FormKitCreateExclude]
    protected Collection $children;

    public function __construct()
    {
        $this->children = new ArrayCollection();
    }

    public function getParent(): ?self
    {
        return $this->parent;
    }

    public function setParent(?self $parent): static
    {
        $this->parent = $parent;

        return $this;
    }

    public function getPosicion(): ?int
    {
        return $this->posicion;
    }

    public function setPosicion(?int $posicion): static
    {
        $this->posicion = $posicion;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getChildren(): Collection
    {
        return $this->children;
    }

    public function addChild(self $child): static
    {
        if (!$this->children->contains($child)) {
            $this->children->add($child);
        }

        return $this;
    }

    public function removeChild(self $child): static
    {
        $this->children->removeElement($child);

        return $this;
    }
}
