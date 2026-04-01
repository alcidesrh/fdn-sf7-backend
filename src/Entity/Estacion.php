<?php

namespace App\Entity;

use App\Attribute\ApiResourcePaginationPage;
use App\Attribute\CollectionMetadataAttribute;
use App\Entity\Base\Traits\LegacyTrait;
use App\Entity\Base\Traits\SluggableTrait;
use App\Repository\EstacionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EstacionRepository::class)]
#[ApiResourcePaginationPage]

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
    #[ORM\JoinColumn(onDelete: 'CASCADE')]
    #[ORM\InverseJoinColumn(onDelete: 'CASCADE')]
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
