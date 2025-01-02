<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\FormKit\SchemaForm;
use App\Entity\Base\NombreNotaStatusBase;
use App\Repository\PermisoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use RecursiveArrayIterator;
use RecursiveIteratorIterator;

#[ORM\Entity(repositoryClass: PermisoRepository::class)]
#[ApiResource]
#[SchemaForm("nombre", "link", "posicion", "status", 'parent', 'children')]
class Permiso extends NombreNotaStatusBase {

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'hijos')]
    public ?self $padre = null;

    #[ORM\OneToMany(mappedBy: 'padre', targetEntity: self::class)]
    private Collection $hijos;


    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'permisos')]
    private Collection $usuarios;

    public function __construct() {
        $this->hijos = new ArrayCollection();
        $this->usuarios = new ArrayCollection();
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function getPadre(): ?self {
        return $this->padre;
    }

    public function setPadre(?self $padre): static {
        $this->padre = $padre;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getHijos(): Collection {
        return $this->hijos;
    }

    public function addHijo(self $hijo): static {
        if (!$this->hijos->contains($hijo)) {
            $this->hijos->add($hijo);
            $hijo->setPadre($this);
        }

        return $this;
    }

    public function removeHijo(self $hijo): static {
        if ($this->hijos->removeElement($hijo)) {
            // set the owning side to null (unless already changed)
            if ($hijo->getPadre() === $this) {
                $hijo->setPadre(null);
            }
        }

        return $this;
    }
    /**
     * @return Collection<int, User>
     */
    public function getUsuarios(): Collection {
        return $this->usuarios;
    }

    public function addUsuario(User $usuario): static {
        if (!$this->usuarios->contains($usuario)) {
            $this->usuarios->add($usuario);
        }

        return $this;
    }
}
