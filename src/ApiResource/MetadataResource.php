<?php

namespace App\ApiResource;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GraphQl\Query;
use App\DTO\MetadataDTO;
use App\Resolver\ColumnsMetadataResolver;
use App\Resolver\CreateFormResolver;
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
        'entity' => ['type' => 'String'],
      ]
    ),
    new Query(
      name: 'columns',
      resolver: ColumnsMetadataResolver::class,
      read: false,
      output: MetadataDTO::class,
      args: [
        'entity' => ['type' => 'String'],
      ]
    ),
  ]
)]
class MetadataResource {

  public \DateTimeInterface $date;

  public function __construct() {
    $this->date = new DateTime();
  }

  #[ApiProperty(identifier: true)]
  public function getDate(): string {
    return $this->date->format('Ymdms');
  }
}
