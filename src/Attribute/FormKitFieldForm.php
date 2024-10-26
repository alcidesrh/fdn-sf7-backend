<?php

namespace App\Attribute;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS | Attribute::IS_REPEATABLE)]
final class FormKitFieldForm {

    public function __construct(public ?array $properties = []) {
    }
}
