<?php

namespace App\ApiResource;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GraphQl\Mutation;
use App\DTO\DeleteMultipleDTO;
use App\Resolver\DeleteMultipleMutationResolver;

#[ApiResource(
  graphQlOperations: [
    new Mutation(
      name: 'delete',
      resolver: DeleteMultipleMutationResolver::class,
      args: ['ids' => ['type' => '[ID]'], 'resource' => ['type' => 'String']],
      read: false,
      write: false,
      output: DeleteMultipleDTO::class,
    ),
  ]
)]
class MultipleResource {
}
