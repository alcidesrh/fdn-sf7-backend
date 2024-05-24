<?php

namespace App\Attribute;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::TARGET_CLASS)]
final class FormKitCreateExclude {

  public $fields = [];
  public function __construct(?string ...$args) {
    $this->fields = $args;
  }
}
