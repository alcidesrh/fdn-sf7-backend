<?php

namespace App\Resolver;

use ApiPlatform\GraphQl\Resolver\QueryItemResolverInterface;
use App\DTO\MetadataDto;

final class MetadataResolver implements QueryItemResolverInterface {


  public function __invoke(?object $item, array $context): object {

    return new MetadataDto();
  }
}
