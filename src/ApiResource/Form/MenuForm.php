<?php

namespace App\ApiResource\Form;

use Doctrine\Common\Collections\ArrayCollection;

class MenuForm extends Form {

  public function __construct(string $className) {
    parent::__construct($className);
  }

  public function getSchema(): array {
    return $this->schema;
  }
}
