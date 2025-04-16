<?php

namespace App\ApiResource;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GraphQl\Query;
use App\DTO\MetadataDTO;
use App\Resolver\ColumnsMetadataResolver;
use App\Resolver\CreateFormResolver;
use App\Security\ABAC;
use DateTime;

#[ApiResource(
  operations: [
    new Get(
      // shortName: 'metadata',
      provider: MetadataResource::class,
      uriTemplate: '/metadata/{className}'
    )
  ],

  graphQlOperations: [
    new Query(
      name: 'get',
      resolver: CreateFormResolver::class,
      read: false,
      output: MetadataDTO::class,
      args: [
        'resource' => ['type' => 'String'],
      ]
    ),
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
