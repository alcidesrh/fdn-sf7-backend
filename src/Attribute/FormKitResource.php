<?php

namespace App\Attribute;

#[\Attribute(\Attribute::TARGET_PARAMETER)]
final class FormKitResource {

  public function __construct(Type $args) {
    # code...
  }
}
