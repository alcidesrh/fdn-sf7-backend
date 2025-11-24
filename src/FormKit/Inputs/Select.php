<?php

namespace App\FormKit\Inputs;


final class Select extends FieldsInput {

  use InputTrait;

  const TYPE = 'select_primevue';

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
