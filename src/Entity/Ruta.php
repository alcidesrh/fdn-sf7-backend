<?php

namespace App\Entity;

use App\Repository\RutaRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RutaRepository::class)]
class Ruta extends Recorrido {

    public function __construct() {
        parent::__construct();
    }
    #[ORM\Column(length: 10, nullable: true)]
    private ?string $codigo = null;

    public function getCodigo(): ?string {
        return $this->codigo;
    }

    public function setCodigo(?string $codigo): static {
        $this->codigo = $codigo;

        return $this;
    }
}
