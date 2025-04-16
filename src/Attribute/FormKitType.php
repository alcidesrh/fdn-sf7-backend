<?php

namespace App\Attribute;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
final class FormKitType {
    public $type;
    public function __construct(?string $type) {
        $this->type = $type;
    }
}
