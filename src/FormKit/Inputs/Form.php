<?php

namespace App\FormKit\Inputs;


final class Form extends FormGroups {

  use InputTrait;

  const TYPE = 'form';

  private Input $cursor;

  private bool $addingVertical = false;

  private bool $addingHorizontal = false;



  public function __construct(array|string $props = '') {

    parent::__construct([
      '$formkit' => self::TYPE,
      'name' => self::TYPE,
      'id' => self::TYPE,
      'actions' => false,
      'modelValue' => '$item'
    ], $props);
  }



  public function addVertical(?bool $flag): self {
    $this->addingVertical = $flag ?? !$this->addingVertical;
    return $this;
  }

  public function addHorizontal(?bool $flag): self {
    $this->addingHorizontal = $flag ?? !$this->addingHorizontal;
    return $this;
  }
}
