<?php

namespace App\Attribute;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS | Attribute::IS_REPEATABLE)]
final class SchemaForm {

    public array $properties;

    public function __construct(public array $data) {

        $this->properties = $data;
    }
}
