<?php

namespace App\FormKit;

use ApiPlatform\Metadata\IriConverterInterface;
use App\Attribute\AttributeUtil;
use App\Attribute\FormKitExclude;
use App\Attribute\FormKitLabel;
use App\Attribute\SchemaForm;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use ReflectionClass;
use ReflectionProperty;
use Symfony\Component\Finder\Finder;

class FormKit extends FormBase {

  protected array $schema = [];
  protected ?string $className;
  protected ?EntityManagerInterface $entityManager;
  protected ?IriConverterInterface $iriConverter;
  protected array $properties;
  protected array $groups;
  protected array $fields;
  protected ReflectionClass $reflectionClass;

  public function __construct(?string $className = null, ?EntityManagerInterface $entityManagerInterface = null, ?IriConverterInterface $iriConverter = null) {
    $this->className = $className;
    $this->entityManager = $entityManagerInterface;
    $this->iriConverter = $iriConverter;
    $this->reflectionClass = new ReflectionClass($this->classPath());
    $this->properties = $this->reflectionClass->getProperties();

    $this->fields = ['id', '_id'];
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
      if (!$data = $this->schema()) {
        if ($formKitFieldForm = $this->reflectionClass->getAttributes(SchemaForm::class)) {
          $data = $formKitFieldForm[0]->newInstance()->properties;
          foreach ($data as $group) {
            $this->schema[] = $this->parseFields($group);
          }
        } else {
          $data = array_map(fn(ReflectionProperty $reflectionProperty) => $reflectionProperty->getName(), $this->reflectionClass->getProperties());
          $this->schema = $this->parseFields($data);
        }
      } else {
        foreach ($data as $group) {
          $this->schema[] = $this->parseFields($group);
        }
      }
      if ($fields = $this->extractFields($data)) {

        $extra = \array_diff(
          \array_map(fn(ReflectionProperty $reflectionProperty) => ($reflectionProperty->getName()), $this->properties),
          $fields
        );
        if (!empty($extra)) {
          $exclude = array_merge($this->excludeBase, $this->exclude ?? []);
          if ($attrsExclude = $this->reflectionClass->getAttributes(FormKitExclude::class)) {
            $exclude = \array_merge($exclude, $attrsExclude[0]->newInstance()->fields);
          }
          $extra = \array_diff($extra, $exclude);

          foreach ($extra as $value) {
            $this->schema[] = $this->schemaGenerate($value);
          }
        }
      }

      return ['form' => $this->schema, 'fields' => $this->fields];
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

  public function parseFields($data): array {
    $temp = [];
    foreach ($data as $key => $value) {
      if (!is_numeric($key)) {
        if ($key != 'children') {
          $temp[$key] = $data[$key];
        } else {
          $temp[$key] = array_map(function ($i) {
            if (is_array($i)) {
              if (isset($i['field'])) {
                return [...$this->schemaGenerate($i['field']), ...array_filter($i, fn($k) => $k != 'field', ARRAY_FILTER_USE_KEY)];
              } else {
                return $this->parseFields($i);
              }
            } else {
              return $this->schemaGenerate($i);
            }
          }, $value);
        }
      } else {
        $temp[$key] = $this->schemaGenerate($value);
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
    $input = $this->getInputType($type, $class);

    $schema = [
      '$formkit' => $input,
      'label' => \ucwords($label),
      'name' => \strtolower($value),
    ];

    if (!$typeInfo->isNullable()) {
      $schema['validation'] = 'required';
    }

    if (($input == 'select_fdn' || $input == 'multiselect_fdn') && $class && $class != \DateTime::class) {

      if (\enum_exists($class)) {

        $schema['options']  = array_map(
          fn($enumItem) => ['label' => $enumItem->value, 'value' => $enumItem->value],
          $class::cases()
        );
      } else {
        $temp = new ArrayCollection($this->entityManager->getRepository($class)->findAll());
        $schema['options']  = $temp->map(fn($el) => ['label' => (string)$el, 'id' => $this->iriConverter->getIriFromResource($el)])->toArray();
        $this->fields[] = [$value => ['id']];
      }
    } else {
      $this->fields[] = $value;
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
      } else if (isset($value['field'])) {
        $fields[] = $value['field'];
      }
    }
    return $fields;
  }

  public function getInputType($type, $class) {

    if (!\in_array($type, ['string', 'int'])) {
      if (\in_array($class, [DateTimeInterface::class, DateTime::class])) {
        return 'datepicker_fdn';
      } elseif ($type == Collection::class || $type == 'array') {
        return 'multiselect_fdn';
      }
      return 'select_fdn';
    }
    return 'text_fdn';
  }
}
