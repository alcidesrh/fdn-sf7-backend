<?php

namespace App\FormKit\Inputs;

use function Symfony\Component\String\u;

final class Fieldset extends FormGroups {

  use InputTrait;

  public function __construct(array $args = []) {
    if (isset($args['type'])) {
      $type = $args['type'];
      unset($args['type']);
    } else {
      $type = 'div';
    }
    parent::__construct([
      '$el' => $type,
    ], $args ? ['attrs' => $args] : []);
  }
}
