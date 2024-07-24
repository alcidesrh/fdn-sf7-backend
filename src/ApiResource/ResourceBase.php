<?php

namespace App\ApiResource;

use ApiPlatform\Metadata\ApiProperty;

class ResourceBase {

  public string $className;

  #[ApiProperty(identifier: true, readable: false)]
  public function getClassName(): string {
    return $this->className;
  }
}
