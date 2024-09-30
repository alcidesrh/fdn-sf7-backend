<?php

namespace App\ApiResource\Form;

use App\Attribute\AttributeUtil;
use App\Attribute\FormKitCreateExclude;
use App\Attribute\FormKitFieldOrder;
use App\Attribute\FormKitLabel;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use ReflectionClass;
use ReflectionProperty;
use Symfony\Component\Finder\Finder;

class Form implements FormInterface {

  protected array $schema = [];
  protected string $className;
  protected EntityManagerInterface $entityManager;
  protected array $properties;
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
  // public function getClassMetadata(string $classResource): ClassMetadata {
  //   return $this->entityManager->getClassMetadata($classResource);
  // }

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

      $info = AttributeUtil::getExtractor();

      $this->excludeAndOrderClassProperties();

      foreach ($this->properties as $property) {

        if (!$typeInfo = $info->getTypes($this->classPath(), $property->getName())[0] ?? null) {
          continue;
        }

        $type = $typeInfo->getBuiltinType();
        $collectionValueTypes = $typeInfo->getCollectionValueTypes();

        if (!empty($collectionValueTypes)) {
          $class =  $collectionValueTypes[0]->getClassName();
        } else {
          $class = $typeInfo?->getClassName();
        }

        $label = $property->getName();
        if ($labelAttrb = $property->getAttributes(FormKitLabel::class)[0] ?? null) {
          $label = $labelAttrb->newInstance()->label;
        }

        $this->schema[$property->getName()] = $this->formKitSchema([
          'name' => $property->getName(),
          'label' => $label,
          'type' => $type,
          'class' => $class

        ]);
      }
      return $this->getSchema();
    } catch (\Throwable $th) {
      throw $th;
    }
  }
  public function getSchema(): array {
    return $this->schema;
  }

  public function classPath(): string {
    return "App\Entity\\{$this->className}";
  }

  public function formKitSchema(array $value) {

    list($name, $label, $type, $class) = \array_values($value);

    $input = self::getInputType($type, $class);

    $schema = [
      '$formkit' => $input,
      'label' => \ucwords($label),
      'name' => \strtolower($name),
      'labelClass' => 'text',
      'validation' => 'required'
    ];

    $aux = function ($el) {
      return ['label' => (string)$el, 'value' => $el->getId()];
    };

    if ($input == 'select' && $class && $class != DateTimeInterface::class) {
      if (\enum_exists($class)) {
        $schema['options']  = array_map(
          fn($enumItem) => "{$enumItem->value}",
          $class::cases()
        );
      } else {
        $schema['options']  = (new ArrayCollection($this->entityManager->getRepository($class)->findAll()))->map($aux)->toArray();
      }
    }
    if ($type == 'array') {
      $schema['multiple'] = true;
    }
    // }


    return $schema;
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

  final static function getInputType($type, $class) {

    if ($type == 'object' || $type == 'array') {
      if ($class == DateTimeInterface::class) {
        return 'date';
      }
      return 'select';
    }
    return 'text';
  }

  public function excludeAndOrderClassProperties() {

    if ($order = $this->reflectionClass->getAttributes(FormKitFieldOrder::class)) {
      $order = $order[0]->newInstance()->order;
      $temp = [];
      foreach ($order as $propertyName) {
        $value = array_filter(
          $this->properties,
          fn(ReflectionProperty $reflectionProperty) => strtolower($reflectionProperty->getName()) == strtolower($propertyName)
        );
        if ($value) {
          $temp[] = array_values($value)[0];
        }
      }

      $this->properties = array_merge($temp, array_udiff_assoc($this->properties, $temp, fn(ReflectionProperty $reflectionProperty, ReflectionProperty $reflectionProperty2) => $reflectionProperty->getName() == $reflectionProperty2->getName() ? 1 : 0));

      if ($exclude = $this->reflectionClass->getAttributes(FormKitCreateExclude::class)) {
        $exclude = $exclude[0]->newInstance()->fields;
        $temp = [];
        foreach ($this->properties as $property) {
          if (in_array($property->name, $exclude) || $property->getAttributes(FormKitCreateExclude::class)) {
            continue;
          }
          $temp[] = $property;
        }
        $this->properties = $temp;
      }
    }
    return $this->properties;
  }
}
