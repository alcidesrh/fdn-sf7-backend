<?php

namespace App\DTO;

final class CollectionMetadataDTO extends DTOBase {

  public function __construct(public int $total = 0, public array $metadata = []) {
  }
}
