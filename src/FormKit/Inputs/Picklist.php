<?php

namespace App\FormKit\Inputs;


final class Picklist extends FieldsInput {

  use InputTrait;

  const TYPE = 'picklist_primevue';

  const PROPS = ['outerClass' => 'picklist-outerClass'];

  public function __construct(array|string $props = '') {

    parent::__construct([
      '$formkit' => self::TYPE,
      'name' => self::TYPE,
      'id' => self::TYPE,
      ...self::PROPS
    ], $props);
  }
}
