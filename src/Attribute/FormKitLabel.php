<?php

namespace App\Attribute;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::TARGET_CLASS)]
final class FormKitLabel {
    public $label;
    public function __construct(?array $label) {
        $this->label = $label;
    }
}
