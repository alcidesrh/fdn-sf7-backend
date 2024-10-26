<?php

namespace App\ApiResource\Form;

use App\Attribute\AttributeUtil;
use App\Attribute\FormKitExclude;
use App\Attribute\FormKitFieldForm;
use App\Attribute\FormKitLabel;
use Doctrine\ORM\EntityManagerInterface;
use ReflectionClass;
use ReflectionProperty;
use Symfony\Component\Finder\Finder;

class Form {

  protected array $schema = [];
  protected string $className;
  protected EntityManagerInterface $entityManager;
  protected array $properties;
  protected array $groups;
  protected ReflectionClass $reflectionClass;

  public function __construct(string $className) {
    $this->className = $className;

    $this->reflectionClass = new ReflectionClass($this->classPath());
    $this->properties = $this->reflectionClass->getProperties();
  }

  public function setEntityManage(EntityManagerInterface $entityManagerInterface): self {
    $this->entityManager = $entityManagerInterface;
    return $this;
  }

  public function getSchema(): array {
    return $this->schema;
  }

  public function form() {

    if ($this->className == 'entity') {
      return [[
        '$formkit' => 'select',
        'label' => 'Entidades',
        'name' => 'entity',
        'options' => $this->getEntityList(true)
      ]];
    }
    try {

      if ($formKitFieldForm = $this->reflectionClass->getAttributes(FormKitFieldForm::class)) {
        $data = $formKitFieldForm[0]->newInstance()->properties;
        foreach ($data as $group) {
          $this->schema[] = $this->parseFileds($group);
        }
      }
      $fields = $this->extractFields($data);

      $extra = \array_diff(
        \array_map(fn(ReflectionProperty $reflectionProperty) => ($reflectionProperty->getName()), $this->properties),
        $fields
      );
      if (!empty($extra) && $exclude = $this->reflectionClass->getAttributes(FormKitExclude::class)) {
        $exclude = $exclude[0]->newInstance()->fields;
        $extra = \array_diff($extra, $exclude);
      }
      foreach ($extra as $value) {
        $this->schema[] = $this->schemaGenerate($value);
      }
      return $this->schema;
    } catch (\Throwable $th) {
      throw $th;
    }
  }

  public function classPath(): string {
    return "App\Entity\\{$this->className}";
  }

  final public static function getEntityList($dir, $pattern = null) {

    $finder = new Finder();
    $finder->files()->in($dir)->depth(0);
    if ($pattern) {
      $finder->name($pattern);
    }
    $options = [];
    foreach ($finder as $file) {
      $options[] = "App\Entity\\{$file->getFilenameWithoutExtension()}";
    }

    return $options;
  }

  public function parseFileds($data): array {
    $temp = [];
    foreach ($data as $key => $value) {
      if (!is_numeric($key)) {
        if ($key != 'children') {
          $temp[$key] = $data[$key];
        } else {
          $temp[$key] = array_map(fn($i) => is_array($i) ? $this->parseFileds($i) : $this->schemaGenerate($i), $value);
        }
      } else {
        $temp[$key][] = $this->schema($value);
      }
    }
    return $temp;
  }

  public function schemaGenerate($value) {
    $info = AttributeUtil::getExtractor();
    if (!$typeInfo = $info->getTypes($this->classPath(), $value)[0] ?? null) {
      return false;
    }
    $property = $this->reflectionClass->getProperty($value);
    $type = $this->reflectionClass->getProperty($value)->getType()->getName();
    $collectionValueTypes = $typeInfo->getCollectionValueTypes();

    if (!empty($collectionValueTypes)) {
      $class =  $collectionValueTypes[0]->getClassName();
    } else {
      $class = $typeInfo?->getClassName();
    }

    $label = $value;
    if ($labelAttrb = $property->getAttributes(FormKitLabel::class)[0] ?? null) {
      $label = $labelAttrb->newInstance()->label;
    }
    $schema = [
      'name' => $value,
      'label' => $label,
      'type' => $type,
      'class' => $class
    ];
    return FormKitBase::formKitSchema($schema, $this->entityManager);
  }

  public function extractFields($data) {
    $fields = [];
    foreach ($data as $value) {
      if (isset($value['children'])) {
        $fields = [...$fields, ...$this->extractFields($value['children'])];
      } else if (is_string($value)) {
        $fields[] = $value;
      }
    }
    return $fields;
  }
}
