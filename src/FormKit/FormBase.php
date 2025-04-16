<?php

namespace App\FormKit;

use App\Services\ReflectionForm;

class FormBase extends ReflectionForm {

  public $excludeBase = ['createdAt', 'legacyId', 'updatedAt', 'label', 'id'];

  protected array $schema = [];

  public function __construct(
    protected string|null $entity = "",
    public array $exclude = []
  ) {
    parent::__construct($entity, $exclude);
  }

  protected function getSchema(): array {

    return $this->schema;
  }
  protected function setSchema($schema = []): void {

    $this->schema = $schema;
  }
}
