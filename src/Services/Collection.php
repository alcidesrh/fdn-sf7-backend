<?php


namespace App\Services;

use App\FormKit\Input;
use Closure;
use Doctrine\Common\Collections\ArrayCollection;

class Collection extends ArrayCollection {

  public function __construct(array $elements = []) {

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

  public function getSchema(): array {
    // $return = array_map(fn(Input $v) => $v(), $this->getValues());
    // $a = get_class($return[0]);
    // $this->createFrom($return);
    return $this->map(fn(Input $v) => $v())->toArray();
  }
}
