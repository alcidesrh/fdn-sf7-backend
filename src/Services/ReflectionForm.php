<?php

namespace App\Services;

use App\Attribute\FormkitSchema;

class ReflectionForm extends Reflection {


  public function __construct(
    string|null $entity = null,
    ?array $exclude = [],
  ) {
    parent::__construct($entity, $exclude);
    $this->setProperties();
  }


  public function setFormFields() {
    if (!$keys = $this->extractFields($this->getSchema())) {
      if ($formKitFieldForm = $this->reflection->classAttribute(FormkitSchema::class)) {
        $keys  = $formKitFieldForm[0]->newInstance()->properties;
      }
    }
  }

  public function getFormSchema() {
    return $this->reflection->getAttributes(FormkitSchema::class);
  }
}
