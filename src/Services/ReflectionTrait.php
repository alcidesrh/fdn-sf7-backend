<?php

namespace App\Services;

use App\Attribute\ExcludeAttribute;
use App\Attribute\PropertyOrder;
use App\Services\Collection;
use ReflectionClass;
use ReflectionProperty;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Symfony\Component\PropertyInfo\PropertyInfoExtractor;

trait ReflectionTrait {

  public static ?ReflectionClass $reflection;
  public static ?Collection $properties;
  public static ?string $entityPath;

  protected function initReflectionTrait($entity) {

    self::setEntityPath($entity);
    self::$reflection = new ReflectionClass(self::$entityPath);
    $this->setProperties();
  }

  private function setProperties() {

    self::$properties = new Collection(self::$reflection->getProperties());

    if ($attrsExclude = self::$reflection->getAttributes(ExcludeAttribute::class)) {
      $exclude = \array_merge($this->exclude, $attrsExclude[0]->newInstance()->fields);
    }

    foreach (self::$reflection->getProperties() as $value) {
      if ($value->getAttributes(ExcludeAttribute::class)) {
        $exclude[] = $value->getName();
      }
    }

    if (!empty($exclude)) {

      self::$properties = self::$properties->filter(fn(ReflectionProperty $reflectionProperty) => !in_array($reflectionProperty->getName(), self::$exclude));
    }

    if ($order = self::$reflection->getAttributes(PropertyOrder::class)) {
      $keys = self::$properties->getKeys();
      $order = $order[0]->newInstance()->fields;
      $keys = [...\array_intersect($order, $keys), ...\array_diff($keys, $order ?? [])];
      self::$properties = new Collection(\array_map(fn($key) => self::$properties->get($key), $keys));
    }
  }
  public function classAttribute($attribute) {
    return self::$reflection->getAttributes($attribute);
  }
  static public function getExtractor() {
    // $phpDocExtractor = new PhpDocExtractor();
    $reflectionExtractor = new ReflectionExtractor();
    // // list of PropertyListExtractorInterface (any iterable)
    $listExtractors = [$reflectionExtractor];
    // // list of PropertyTypeExtractorInterface (any iterable)
    $typeExtractors = [$reflectionExtractor];
    // // list of PropertyAccessExtractorInterface (any iterable)
    $accessExtractors = [$reflectionExtractor];
    // // list of PropertyInitializableExtractorInterface (any iterable)
    $propertyInitializableExtractors = [$reflectionExtractor];

    return new PropertyInfoExtractor(
      $listExtractors,
      $typeExtractors,
      [],
      $accessExtractors,
      $propertyInitializableExtractors
    );
  }
  static public function setEntityPath($entity) {
    self::$entityPath = "App\Entity\\" . $entity;
  }
}
