<?php

namespace App\FormKit\Inputs;

final class Text extends FieldsInput {

  use InputTrait;

  const TYPE = 'text';

  public function __construct(array|string $props = '') {

    parent::__construct([
      '$formkit' => self::TYPE,
      'name' => self::TYPE,
      'id' => self::TYPE
    ], $props);
  }
}
