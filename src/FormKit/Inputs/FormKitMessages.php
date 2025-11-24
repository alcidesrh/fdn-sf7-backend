<?php

namespace App\FormKit\Inputs;

use function Symfony\Component\String\u;

final class FormKitMessages extends FormGroups {

  use InputTrait;

  public function __construct(array $props = []) {

    parent::__construct([
      '$cmp' => 'FormKitMessages',
    ], ['props' => [
      'attrs' => $props
    ],]);
  }
}
