<?php

namespace App\FormKit\Inputs;

final class DateInput extends FieldsInput {

  use InputTrait;

  const TYPE = 'datepicker_primevue';

  const DEFAULT = ['dateFormat' => "dd/mm", 'selectionMode' => "range", 'selectionMode' => 'range', 'hourFormat' => 12, 'showTime' => true];

  public function __construct(array|string $props = '') {

    parent::__construct([
      '$formkit' => self::TYPE,
      'name' => self::TYPE,
      'id' => self::TYPE,
      ...self::DEFAULT
    ], $props);
  }
}
