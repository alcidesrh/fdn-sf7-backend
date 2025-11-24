<?php

namespace App\FormKit\Inputs;

use function Symfony\Component\String\u;

final class Fieldset extends FormGroups {

  use InputTrait;

  public function __construct(array $props = []) {

    parent::__construct([
      '$cmp' => 'FieldsetPrimevue',
    ], ['props' => [
      'attrs' => ['toggleable' => true, ...$props]
    ],]);
  }
}
