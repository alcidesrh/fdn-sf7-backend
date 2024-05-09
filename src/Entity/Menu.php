<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\MenuRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MenuRepository::class)]
#[ApiResource]
class Menu {
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @var Collection<int, MenuItem>
     */
    #[ORM\ManyToMany(targetEntity: MenuItem::class)]
    private Collection $menuItems;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $seccion = null;

    public function __construct() {
        $this->menuItems = new ArrayCollection();
    }

    public function getId(): ?int {
        return $this->id;
    }

    /**
     * @return Collection<int, MenuItem>
     */
    public function getMenuItems(): Collection {
        return $this->menuItems;
    }

    public function addMenuItem(MenuItem $menuItem): static {
        if (!$this->menuItems->contains($menuItem)) {
            $this->menuItems->add($menuItem);
        }

        return $this;
    }

    public function removeMenuItem(MenuItem $menuItem): static {
        $this->menuItems->removeElement($menuItem);

        return $this;
    }

    public function getSeccion(): ?string
    {
        return $this->seccion;
    }

    public function setSeccion(?string $seccion): static
    {
        $this->seccion = $seccion;

        return $this;
    }
}
