<?php

namespace App\ApiResource\Form;

class FormFactory {
  final public static function create($resource): Form {

    $form = "{$resource}Form";
    return \file_exists(__DIR__ . '/' . $form . '.php') ?  new (__NAMESPACE__ . '\\' . $form)($resource) : new Form($resource);
  }
}
