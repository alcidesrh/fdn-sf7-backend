<?php

namespace App\Attribute;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS | Attribute::IS_REPEATABLE)]
final class ColumnTableList {
    public $columns = [];

    public function __construct(?string ...$args) {
        $this->columns = $args;
    }
}
