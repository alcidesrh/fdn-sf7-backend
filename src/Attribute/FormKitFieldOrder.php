<?php

namespace App\Attribute;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS | Attribute::IS_REPEATABLE)]
final class FormKitFieldOrder {
    public $order = [];

    public function __construct(?string ...$args) {
        $this->order = $args;
    }
}
