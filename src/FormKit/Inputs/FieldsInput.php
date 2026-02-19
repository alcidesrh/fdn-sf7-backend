<?php

namespace App\FormKit\Inputs;

use App\Services\Collection;
use function Symfony\Component\String\u;

class FieldsInput extends Input {

  public static $inputBase = ['name' => ''];

  public function __construct(array $input, array|string $props = []) {
    $this->children = new Collection();
    if (!\is_array($props)) {
      $input['name'] = $input['id'] = $input['label'] = $props;
    } else {
      $input = [...$input, ...$props];
    }
    // $input['sections-schema'] = [

    //   'outer' => ['attrs' => ['class' => 'form-outer']],
    //   'wrapper' => ['attrs' => ['class' => 'form-wrapper']],
    //   // 'input' => ['$el' => null],
    //   'inner' => ['attrs' => ['class' => 'form-inner']],
    //   'label' => ['$el'  => 'div', 'attrs' => ['class' => 'form-label']],
    //   // inner: { $el: null },
    //   // messages: { $el: null },
    //   // message: { $el: 'div' },

    // ];
    parent::__construct([...self::$inputBase, ...$input]);
  }
}
