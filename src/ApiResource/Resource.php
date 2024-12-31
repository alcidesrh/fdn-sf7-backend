<?php

namespace App\ApiResource;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GraphQl\Query;
use App\DTO\DeleteMultipleDTO;
use App\DTO\ResourceDTO;
use App\Entity\Base\Base;
use App\Entity\User;
use App\Provider\ResourceAccessProvider;
use App\Resolver\ResourceResolver;

#[ApiResource(
  graphQlOperations: [
    new Query(
      name: 'get',
      resolver: ResourceResolver::class,
      output: ResourceDTO::class,
      read: false,
      write: false,
      args: [
        'entity' => ['type' => 'String'],
        'field' => ['type' => 'String'],
        'value' => ['type' => 'String']
      ]
    ),
  ]
)]
class Resource {
}
