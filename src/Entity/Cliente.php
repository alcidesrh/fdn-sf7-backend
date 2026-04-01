<?php

namespace App\Entity;

use App\Attribute\ApiResourcePaginationPage;
use App\Entity\Base\PersonaBase;
use App\Repository\ClienteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClienteRepository::class)]
#[ApiResourcePaginationPage]
class Cliente extends PersonaBase {

    #[ORM\Column(length: 15, nullable: true)]
    private ?string $dpi = null;
    public function getDpi(): ?string {
        return $this->dpi;
    }

    public function setDpi(?string $dpi): static {
        $this->dpi = $dpi;

        return $this;
    }
}
