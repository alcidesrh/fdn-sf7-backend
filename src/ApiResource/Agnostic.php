<?php

namespace App\ApiResource;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GraphQl\Mutation;
use ApiPlatform\Metadata\GraphQl\Query;
use App\DTO\DeleteMultipleDTO;
use App\DTO\MetadataDTO;
use App\Resolver\CollectionResolver;
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
    new Query(),
    new Query(
      name: 'collection',
      resolver: CollectionResolver::class,
      read: false,
      args: ['resource' => ['type' => 'String'], 'fields' => ['type' => '[String]']],
      output: MetadataDTO::class,
    ),
  ]
)]
class Agnostic {

  public function __construct(public array $data = []) {
    $id = new \DateTime();
  }
}
