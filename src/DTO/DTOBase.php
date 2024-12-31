<?php

namespace App\DTO;

use ApiPlatform\Metadata\ApiProperty;

class DTOBase {

  public ?\DateTimeInterface $id = null;

  #[ApiProperty(identifier: true, writable: false)]
  public function getId(): string {
    return (new \DateTime())->format('Ymdms');
  }
}
