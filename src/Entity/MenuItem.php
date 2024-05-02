<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Attribute\FormKitFieldOrder;
use App\Repository\MenuItemRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MenuItemRepository::class)]
#[ApiResource]
#[FormKitFieldOrder("nombre", "link", "posicion", "status", 'parent', 'children')]
class MenuItem extends Taxon
{

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $link = null;


    public function getLink(): ?string
    {
        return $this->link;
    }

    public function setLink(?string $link): static
    {
        $this->link = $link;

        return $this;
    }
}
