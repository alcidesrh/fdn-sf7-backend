<?php

namespace App\DTO;

use ApiPlatform\Metadata\ApiProperty;
use DateTime;

class DTOBase {

  public ?\DateTimeInterface $id = null;

  #[ApiProperty(identifier: true, writable: false)]
  public function getId(): string {
    return $this->id->format('Ymdms');
  }
}
