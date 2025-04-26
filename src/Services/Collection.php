<?php


namespace App\Services;

use App\FormKit\Input;
use Closure;
use Doctrine\Common\Collections\ArrayCollection;

class Collection extends ArrayCollection {

  public function __construct(array|string $elements = []) {

    if (!\is_array($elements)) {
      $elements = [$elements];
    }

    parent::__construct($elements);
  }

  public function findFirstKeyAndValue(Closure $p) {
    foreach ($this->getValues() as $key => $element) {
      if ($p($key, $element)) {
        return ['key' => $key, 'value' => $element];
      }
    }

    return null;
  }


  protected function createFrom(array $elements) {
    return new self($elements);
  }
}
