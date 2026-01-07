<?php

namespace App\FormKit\Inputs;

final class Checkbox extends FieldsInput {

  use InputTrait;

  const TYPE = 'checkbox';

  public function __construct(array|string $props = '') {

    parent::__construct([
      '$formkit' => self::TYPE,
      'name' => self::TYPE,
      'id' => self::TYPE
    ], $props);
  }
}
