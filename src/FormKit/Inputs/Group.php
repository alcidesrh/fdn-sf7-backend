<?php

namespace App\FormKit\Inputs;


final class Group extends FormGroups {

  use InputTrait;

  const TYPE = 'group';

  public function __construct(array|string $props = '') {

    parent::__construct([
      '$formkit' => self::TYPE,
      'name' => self::TYPE,
      'id' => self::TYPE
    ], $props);
  }
}
