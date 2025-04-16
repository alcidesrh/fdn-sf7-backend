<?php

namespace App\Attribute;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::TARGET_CLASS)]
final class FormkitLabel {
    public $label;
    public function __construct(?string $label) {
        $this->label = $label;
    }
}
