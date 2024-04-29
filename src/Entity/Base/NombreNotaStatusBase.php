<?php

namespace App\Entity\Base;

use App\Entity\Base\Interfaces\StatusInterface;
use App\Entity\Base\Traits\StatusTrait;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;


class NombreNotaStatusBase extends Base implements StatusInterface {

  use StatusTrait;

  #[ORM\Column(length: 255, nullable: true)]
  protected ?string $nombre = null;

  #[ORM\Column(type: Types::TEXT, nullable: true)]
  protected ?string $nota = null;

  public function getNombre(): ?string {
    return $this->nombre;
  }
  public function setNombre(string $nombre): static {
    $this->nombre = $nombre;

    return $this;
  }
  public function getNota(): ?string {
    return $this->nota;
  }

  public function setNota(string $nota): static {
    $this->nota = $nota;

    return $this;
  }
}
