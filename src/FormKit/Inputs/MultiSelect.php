<?php

namespace App\FormKit\Inputs;


final class MultiSelect extends Select {

  use InputTrait;

  const TYPE = 'select';

  const DEFAULT = ['multiple' => true];

  public function __construct(array|string $props = '') {
    $args = [
      '$formkit' => self::TYPE,
      'name' => self::TYPE,
      'id' => self::TYPE,
      ...self::DEFAULT,
    ];
    if (!is_array($props)) {
      $args['name'] = $args['id'] = $args['label'] = $props;
    }
    parent::__construct($args);
  }
}
