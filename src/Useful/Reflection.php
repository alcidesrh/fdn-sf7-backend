<?php

namespace App\Useful;

use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Symfony\Component\PropertyInfo\PropertyInfoExtractor;
use Symfony\Component\TypeInfo\Type;

class Reflection {

  public static function extractor(): PropertyInfoExtractor {

    $extractor = [new ReflectionExtractor()];
    return new PropertyInfoExtractor(typeExtractors: $extractor, accessExtractors: $extractor, initializableExtractors: $extractor, listExtractors: $extractor);
  }

  public static function getType(string $entity, string $property) {

    return Reflection::extractor()->getTypes($entity, $property)[0] ?? null;
  }
}
