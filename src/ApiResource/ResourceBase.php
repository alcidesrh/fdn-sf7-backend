<?php

namespace App\ApiResource;

use ApiPlatform\Metadata\ApiProperty;
use function Symfony\Component\String\u;

class ResourceBase {

  public string $className;


  #[ApiProperty(identifier: true, readable: false)]
  public function getClassName(): string {
    return $this->className;
  }

  public static function entityNameParse(string $className, $noPrefix = false): string {

    $className = u($className)->camel()->title();
    return ($noPrefix ? $className : "App\Entity\\$className");
  }
}
