<?php

namespace App\ApiResource;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use App\Provider\ResourceAccessProvider;

#[ApiResource(
  shortName: 'resource',
  provider: ResourceAccessProvider::class,
  operations: [
    new Get()
  ]

)]
class ResourceAccess {



  public function __construct() {
  }
}
