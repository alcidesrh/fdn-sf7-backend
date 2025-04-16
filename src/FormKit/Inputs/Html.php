<?php

namespace App\FormKit\Inputs;

final class Html extends FormGroups {

  use InputTrait;

  const TYPE = 'html_primevue';

  public static $inputBase = [];

  public function __construct($args = []) {
    if (isset($args['$el'])) {
      $type = $args['$el'];
      unset($args['$el']);
    } else {
      $type = 'div';
    }
    parent::__construct([
      '$el' => $type,
    ], $args ? ['attrs' => $args] : []);
  }
}
