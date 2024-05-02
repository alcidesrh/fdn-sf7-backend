<?php

namespace App\Attribute;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
final class FormKitLabel
{

    public function __construct(public string $label)
    {
    }
}
