<?php

namespace App\FormKit;

class FormBase {

  public $excludeBase = ['createdAt', 'legacyId', 'updatedAt'];

  protected function schema(): array {
    return [];
  }
}
