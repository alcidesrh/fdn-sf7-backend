<?php

namespace App\FormKit\Inputs;

final class Password extends FieldsInput {

  use InputTrait;

  const TYPE = 'password_primevue';

  const DEFAULT = ['toggleMask' => true, 'feedback' => false];

  public function __construct(array|string $props = '') {

    parent::__construct([
      '$formkit' => self::TYPE,
      'name' => self::TYPE,
      'id' => self::TYPE,
      ...self::DEFAULT
    ], $props);
  }
}
