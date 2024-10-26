<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Attribute\FormKitExclude;
use App\Attribute\FormKitFieldForm;
use App\Attribute\FormKitLabel;
use App\Repository\MenuRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MenuRepository::class)]
#[ApiResource]
#[FormKitFieldForm("nombre", "link", "posicion", "status", 'parent', 'children')]
#[FormKitExclude("status", "parent")]
#[FormKitLabel(['nombre' => 'texto'])]
class Menu extends Taxon {

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $link = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $tipo = null;


    public function getLink(): ?string {
        return $this->link;
    }

    public function setLink(?string $link): static {
        $this->link = $link;

        return $this;
    }

    public function getTipo(): ?string {
        return $this->tipo;
    }

    public function setTipo(?string $tipo): static {
        $this->tipo = $tipo;

        return $this;
    }
}
