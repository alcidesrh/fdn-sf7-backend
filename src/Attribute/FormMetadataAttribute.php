<?php

namespace App\Attribute;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS | Attribute::IS_REPEATABLE | Attribute::TARGET_PROPERTY)]
final class FormMetadataAttribute {

    public array|string $data;

    public function __construct(...$data) {

        $this->data = $data;
    }
}
