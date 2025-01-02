<?php

namespace App\FormKit;

class FormBase {

  public $excludeBase = ['createdAt', 'legacyId', 'updatedAt', 'label'];

  protected function schema(): array {
    return [];
  }
}
