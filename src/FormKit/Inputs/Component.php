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

  public static function createAccordion(array|string $props = ''): self {

    return new self(
      'AccordionPrimevue',
      self::setInput($props)
    );
  }

  public static function createFieldset(array|string $props = ''): self {

    return new self('FieldsetPrimevue', self::setInput([
      // 'legend' => 'Menus relacionados',
      'toggleable' => true,
      'style' => 'float: left; min-width: 20em; max-width: 100%; overflow: scroll;',
      // 'id' => 'menu_menus',
      ...$props
    ]));
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
        'id' => $name,
        'value' => '$value',
        'context' => '$node.context',
        'attrs' => ['style' => 'margin-bottom: 20px', 'toggleable' => true, ...$props]
      ],
    ];
  }
}
