<?php

namespace App\Attribute;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
final class FormKitDataReference {
    public $label;
    public function __construct(?string $label) {
        $this->label = $label;
    }
}
