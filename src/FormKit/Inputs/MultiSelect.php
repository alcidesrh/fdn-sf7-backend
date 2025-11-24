<?php

namespace App\FormKit\Inputs;


final class MultiSelect extends FieldsInput {

  use InputTrait;

  const TYPE = 'multiselect_primevue';

  const DEFAULT = ['display' => "chip", 'optionLabel' => "label",  'filter' => true, 'placeholder' => "Seleccionar"];

  public function __construct(array|string $props = '') {

    parent::__construct([
      '$formkit' => self::TYPE,
      'name' => self::TYPE,
      'id' => self::TYPE,
      ...self::DEFAULT
    ], $props);
  }
}
