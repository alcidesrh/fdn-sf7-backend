<?php

namespace App\DTO;

use App\Entity\Estacion;
use App\Entity\User;

final class ResourceDTO extends DTOBase {

  public ?User $user;
  public ?Estacion $estacion;

  public function __construct() {
    $this->id = new \DateTime();
  }
}
