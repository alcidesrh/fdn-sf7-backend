<?php

namespace App\FormKit\Inputs;

trait InputTrait {

  public static function create(array|string $args = []): self {
    return new self($args);
  }
}
