<?php

namespace App\FormKit\Inputs;


final class Accordion extends FormGroups {

  use InputTrait;

  public function __construct(array $props = []) {

    parent::__construct([
      '$cmp' => 'AccordionPrimevue',
    ], ['props' => [
      'attrs' => $props
    ],]);
  }
}
