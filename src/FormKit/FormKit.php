<?php

namespace App\FormKit;

use ApiPlatform\Metadata\IriConverterInterface;
use App\Attribute\AttributeUtil;
use App\Attribute\FormkitLabel;
use App\Attribute\FormkitDataReference;
use App\Attribute\FormKitType;
use App\Attribute\FormkitSchema;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\EntityManagerInterface;
use ReflectionProperty;

class FormKit extends FormBase {


  protected ?EntityManagerInterface $entityManager;
  protected ?IriConverterInterface $iriConverter;

  public function __construct(?string $className = null, ?EntityManagerInterface $entityManagerInterface = null, ?IriConverterInterface $iriConverter = null) {

    $this->entityManager = $entityManagerInterface;
    $this->iriConverter = $iriConverter;

    $exclude = array_merge($this->excludeBase, $this->exclude ?? []);

    parent::__construct($className, $exclude);

    if ($schema = $this->getSchema()) {
      $fields = $this->extractFields($schema);
    } else {
      if ($formKitFieldForm = $this->classAttribute(FormkitSchema::class)) {
        $fields  = $formKitFieldForm[0]->newInstance()->properties;
      } else {
        $fields = $this->properties->getKeys();
      }
      $this->schema[] = ['wrapper' => true, 'type' => 'div', 'children' => $fields];
    }

    if ($extra = \array_values(\array_diff(
      $this->properties->map(fn(ReflectionProperty $reflectionProperty) => $reflectionProperty->getName())->getValues(),
      $fields,
      $exclude
    ))) {

      // $this->schema[] = Input::fieldset(style: 'float: left', legend: 'Otros datos', children: $extra);
      // [
      //   'wrapper' => true,
      //   'type' => 'Fieldset',
      //   'props' =>
      //   ,
      //   'children' => $extra
      // ];
    }
  }

  public function getForm(): array {
    return $this->form();
  }
  public function form(): array {
    try {

      $data = [];

      foreach ($this->getSchema() as $group) {
        $data[] = $this->parseFields($group);
      }
      return ['form' => $data];
    } catch (\Throwable $th) {
      throw $th;
    }
  }


  public function parseFields($data): array {
    $temp = [];
    if (!is_array($data)) {
      return $this->schemaGenerate($data);
    }
    foreach ($data as $key => $value) {
      if (!is_numeric($key)) {
        if ($key != 'children') {
          $temp[$key] = $data[$key];
        } else {
          $temp[$key] = \array_filter(\array_map(function ($i) {
            if (\is_array($i)) {
              if (isset($i['field'])) {
                return [...$this->schemaGenerate($i['field']), ...array_filter($i, fn($k) => $k != 'field', ARRAY_FILTER_USE_KEY)];
              } else {
                return $this->parseFields($i);
              }
            } else {
              return $this->schemaGenerate($i);
            }
          }, $value), fn($v) => $v);
        }
      } else {
        $temp[$key] = $this->schemaGenerate($value);
      }
    }
    return $temp;
  }

  public function schemaGenerate($field) {
    $info = AttributeUtil::getExtractor();

    if (!$typeInfo = $info->getTypes($this->classPath(), $field)[0] ?? null) {
      return false;
    }
    $property = $this->reflection->getProperty($field);
    if ($type = $property->getAttributes(FormkitSchema::class)[0] ?? null) {
      $type = $type->newInstance()->data;
    } else {
      $type = $this->reflection->getProperty($field)->getType()->getName();
    }
    $collectionValueTypes = $typeInfo->getCollectionValueTypes();

    if (!empty($collectionValueTypes)) {
      $class =  $collectionValueTypes[0]->getClassName();
    } else {
      $class = $typeInfo?->getClassName();
    }

    $label = $field;
    if ($labelAttrb = $property->getAttributes(FormkitLabel::class)[0] ?? null) {
      $label = $labelAttrb->newInstance()->label;
    }
    $input = $this->getInputType($type, $class);

    $schema = [
      '$formkit' => $input,
      'label' => \ucwords($label),
      'name' => $field,
      // 'id' => $name,
    ];

    if (!$typeInfo->isNullable()) {
      $schema['validation'] = 'required';
    }

    if (($input == 'select' || $input == 'multiselect') && $class && $class != \DateTime::class) {

      if (\enum_exists($class)) {

        $schema['options']  = array_map(
          fn($enumItem) => ['label' => $enumItem->value, 'value' => $enumItem->value],
          $class::cases()
        );
      } else {
        if ($selfRelation = $property->getAttributes(FormkitSchema::class)[0] ?? null) {
          $schema  = $selfRelation->newInstance()->data;
        } else {
          $temp = new ArrayCollection($this->entityManager->getRepository($class)->findAll());
          $schema['options']  = $temp->map(fn($el) => ['label' => (string)$el, 'value' => $this->iriConverter->getIriFromResource($el)])->toArray();
        }
      }
    }
    if ($type == 'array') {
      $schema['multiple'] = true;
    }
    return $schema;
  }

  public function extractFields($data) {
    $fields = [];
    foreach ($data as $value) {
      if (isset($value['children'])) {
        $fields = [...$fields, ...$this->extractFields($value['children'])];
      } else if (is_string($value)) {
        $fields[] = $value;
      } else if (isset($value['field']) || isset($value['name'])) {
        $fields[] = $value['field'] ?? $value['name'];
      }
    }
    return $fields;
  }

  public function getInputType($type, $class) {

    if ($type == 'string') {
      return 'text';
    }
    if ($type == 'int') {
      return 'number';
    }
    if ($type == 'picklist') {
      return 'picklist';
    }
    if (\in_array($class, [DateTimeInterface::class, DateTime::class])) {
      return 'datepicker';
    }
    if ($type == Collection::class || $type == 'array') {
      return 'multiselect';
    }
    return 'select';

    if (!\in_array($type, ['string', 'int'])) {
      if (\in_array($class, [DateTimeInterface::class, DateTime::class])) {
        return 'datepicker';
      } elseif ($type == Collection::class || $type == 'array') {
        return 'multiselect';
      }
      return 'select';
    }
  }
}
