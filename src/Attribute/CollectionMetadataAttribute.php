<?php

namespace App\Attribute;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS | Attribute::IS_REPEATABLE)]
final class CollectionMetadataAttribute {
    public array|string $data;

    public function __construct(...$data) {

        $this->data = $data;
    }
}
