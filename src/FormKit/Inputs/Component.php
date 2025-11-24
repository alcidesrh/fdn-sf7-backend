<?php

namespace App\FormKit\Inputs;

use function Symfony\Component\String\u;

final class Component extends FormGroups {

  use InputTrait;

  public function __construct($cmp, array|string $props = '') {

    parent::__construct([
      '$cmp' => $cmp,
    ], $props);
  }


  public static function createComponent($name): self {

    return new self($name);
  }

  public static function setInput($props) {

    $name = 'componentes';
    if (\is_string($props)) {
      $name =  u($props)->snake();
      $props = [];
    } else  if (\array_key_exists('name', $props)) {
      $name = u($props['name'])->snake();
      unset($props['name']);
    }

    return  [
      'props' => [
        'name' => $name,
        'attrs' => [...$props]
      ],
    ];
  }
}
