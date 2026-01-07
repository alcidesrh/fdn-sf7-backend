<?php

namespace App\FormKit\Inputs;


final class Picklist extends FieldsInput {

  use InputTrait;

  const TYPE = 'picklist';

  const PROPS = ['outerClass' => 'picklist-outerClass'];

  public function __construct(array|string $props = '') {

    parent::__construct([
      '$formkit' => self::TYPE,
      'name' => self::TYPE,
      'id' => self::TYPE,
      ...self::PROPS
    ], [
      'name' => "picklist",
      'icon' => 'material-symbols:person-off-outline',
      'options' => '$options',
      'allowItems' => 'allowItems',
      'labelClass' => 'picklist-labelClass',
      'label' => false,
      ...$props
    ]);
  }
}
