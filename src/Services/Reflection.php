<?php

namespace App\Services;

use App\Attribute\ExcludeAttribute;
use App\Attribute\PropertyOrder;
use App\Services\Collection;
use ReflectionClass;
use ReflectionProperty;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Symfony\Component\PropertyInfo\PropertyInfoExtractor;

class Reflection {

  public ?ReflectionClass $reflection;
  public ?Collection $properties;
  public ?string $entityPath;

  public function __construct(
    protected string|null $entity = "",
    private array $exclude = []
  ) {

    $this->reflection = new ReflectionClass($this->classPath());
    $this->setProperties();
  }

  static public function pathByEntityName($entity): string {
    return "App\Entity\\" . $entity;
  }

  public function classPath($entity = null): string|null {
    if ($temp = ($entity ?? $this->entity)) {
      return self::pathByEntityName($temp);
    }
    return null;
  }


  public function setProperties() {

    $this->properties = new Collection($this->reflection->getProperties());

    if ($attrsExclude = $this->reflection->getAttributes(ExcludeAttribute::class)) {
      $exclude = \array_merge($this->exclude, $attrsExclude[0]->newInstance()->fields);
    }

    foreach ($this->reflection->getProperties() as $value) {
      if ($value->getAttributes(ExcludeAttribute::class)) {
        $exclude[] = $value->getName();
      }
    }

    if (!empty($exclude)) {

      $this->properties = $this->properties->filter(fn(ReflectionProperty $reflectionProperty) => !in_array($reflectionProperty->getName(), $this->exclude));
    }

    if ($order = $this->reflection->getAttributes(PropertyOrder::class)) {
      $keys = $this->properties->getKeys();
      $order = $order[0]->newInstance()->fields;
      $keys = [...\array_intersect($order, $keys), ...\array_diff($keys, $order ?? [])];
      $this->properties = new Collection(\array_map(fn($key) => $this->properties->get($key), $keys));
    }
  }

  public static function extractor(): PropertyInfoExtractor {

    $extractor = [new ReflectionExtractor()];
    return new PropertyInfoExtractor(typeExtractors: $extractor, accessExtractors: $extractor, initializableExtractors: $extractor, listExtractors: $extractor);
  }

  public static function getType(string $entity, string $property) {

    return Reflection::extractor()->getTypes($entity, $property)[0] ?? null;
  }
}
