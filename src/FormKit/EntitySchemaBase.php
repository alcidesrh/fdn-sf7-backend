<?php

namespace App\FormKit;

class EntitySchemaBase {

  protected $class;
  public function __construct(protected Schema $schema) {
  }

  public function entity($entity) {
    $this->class = $entity;
  }
  public function getShema($entity, $schemaArray = []): object {

    return  new class(
      $this->schema->build($entity, $schemaArray)->formkitSchema()
    ) implements SchemaInterface {

      public function __construct(public array $schema) {
      }

      public function getSchema(): array {
        return $this->schema;
      }
    };
  }
}
