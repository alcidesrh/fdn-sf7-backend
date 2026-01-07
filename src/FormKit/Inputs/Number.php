<?php

namespace App\FormKit\Inputs;


final class Number extends FieldsInput {

  use InputTrait;

  const TYPE = 'number';

  public function __construct(array|string $props = '') {


    parent::__construct([
      '$formkit' => self::TYPE,
      'name' => self::TYPE,
      'id' => self::TYPE
    ], $props);
  }
}
