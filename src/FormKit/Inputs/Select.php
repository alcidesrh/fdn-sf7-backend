<?php

namespace App\FormKit\Inputs;


class Select extends FieldsInput {

  use InputTrait;

  const TYPE = 'select';

  public function __construct(array|string $props = '') {

    parent::__construct(
      [
        '$formkit' => self::TYPE,
        'name' => self::TYPE,
        'id' => self::TYPE,
        'optionLabel' => 'label',
        'optionValue' => 'id',
        'placeholder' => 'Seleccionar'
      ],
      $props
    );
  }
}
