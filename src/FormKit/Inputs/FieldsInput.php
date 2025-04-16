<?php

namespace App\FormKit\Inputs;

use App\Services\Collection;
use function Symfony\Component\String\u;

class FieldsInput extends Input {

  public static $inputBase = ['name' => '', 'label' => '', 'validation' => false];

  public function __construct(array $input, array|string $props = []) {
    $this->children = new Collection();
    if (!\is_array($props)) {
      $input['name'] = $input['id'] = $input['label'] = u($props)->snake();
    } else {
      $input = [...$input, ...$props];
    }
    parent::__construct([...self::$inputBase, ...$input]);
  }
}
