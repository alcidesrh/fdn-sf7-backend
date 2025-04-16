<?php

namespace App\FormKit;

use ApiPlatform\Metadata\IriConverterInterface;
use App\FormKit\Inputs\Input;
use App\Services\FormkitReflection;
use Doctrine\ORM\EntityManagerInterface;

class Schema extends FormkitReflection {

  public function __construct($className, ?EntityManagerInterface $entityManager, ?IriConverterInterface $iriConverter,) {

    parent::__construct($className, $entityManager, $iriConverter);
  }



  public function getSchema(): array {
    // $return = array_map(fn(Input $v) => $v(), $this->getValues());
    // $a = get_class($return[0]);
    // $this->createFrom($return);
    return $this->map(fn(Input $v) => $v())->toArray();
  }
}
