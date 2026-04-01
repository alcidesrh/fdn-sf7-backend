<?php

namespace App\Entity;

use App\Entity\Base\NombreNotaStatusBaseSuperClass;
use App\Repository\ParadaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Attribute\ApiResourcePaginationPage;

#[ORM\Entity(repositoryClass: ParadaRepository::class)]
#[ApiResourcePaginationPage]
class Parada extends NombreNotaStatusBaseSuperClass {
    #[ORM\ManyToOne]
    private ?Enclave $enclave = null;

    #[ORM\ManyToMany(targetEntity: Recorrido::class, inversedBy: 'paradas')]
    #[ORM\JoinColumn(onDelete: 'CASCADE')]
    #[ORM\InverseJoinColumn(onDelete: 'CASCADE')]
    private Collection $recorridos;

    public function __construct() {
        $this->recorridos = new ArrayCollection();
    }


    public function getEnclave(): ?Enclave {
        return $this->enclave;
    }

    public function setEnclave(?Enclave $enclave): static {
        $this->enclave = $enclave;

        return $this;
    }

    /**
     * @return Collection<int, Recorrido>
     */
    public function getRecorridos(): Collection {
        return $this->recorridos;
    }

    public function addRecorrido(Recorrido $recorrido): static {
        if (!$this->recorridos->contains($recorrido)) {
            $this->recorridos->add($recorrido);
        }

        return $this;
    }

    public function removeRecorrido(Recorrido $recorrido): static {
        $this->recorridos->removeElement($recorrido);

        return $this;
    }
}
