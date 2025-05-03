<?php

namespace App\ApiResource;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GraphQl\Query;
use App\DTO\MetadataDTO;
use App\Resolver\ColumnsMetadataResolver;
use App\Security\ABAC;

#[ApiResource(
  operations: [
    new Get(
      provider: MetadataResource::class,
      uriTemplate: '/metadata/{className}'
    )
  ],

  graphQlOperations: [
    new Query(
      name: 'columns',
      resolver: ColumnsMetadataResolver::class,
      read: false,
      output: MetadataDTO::class,
      args: [
        'resource' => ['type' => 'String'],
      ]
    ),
  ]
)]
class MetadataResource {

  public function __construct(private ABAC $casbin) {
    $temp = $casbin->test();
  }
}
