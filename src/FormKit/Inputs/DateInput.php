<?php

namespace App\FormKit\Inputs;

final class DateInput extends FieldsInput {

  use InputTrait;

  const TYPE = 'primevue_datepicker';

  public function __construct(array|string $props = '') {

    parent::__construct([
      '$formkit' => self::TYPE,
      'name' => self::TYPE,
      'id' => self::TYPE
    ], $props);
  }
}
