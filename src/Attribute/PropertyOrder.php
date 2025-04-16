<?php

namespace App\Attribute;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS)]
final class PropertyOrder {

  public $fields = [];
  public function __construct(?string ...$args) {
    $this->fields = $args;
  }
}
