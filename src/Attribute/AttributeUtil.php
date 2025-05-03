<?php

namespace App\Attribute;

use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\Finder\Finder;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Symfony\Component\PropertyInfo\PropertyInfoExtractor;

final class AttributeUtil {


  public function __construct(#[Autowire('%kernel.project_dir%/src/Entity')]
  private $resourcePath) {
    # code...
  }

  static function getExtractor() {
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

  public function getResources(bool $name) {

    $finder = new Finder();
    // find all files in the current directory
    $finder->files()->in($this->resourcePath)->depth(0);
    $options = [];
    foreach ($finder as $file) {
      if ($name) {
        $options[] = $file->getFilenameWithoutExtension();
      } else {
        $options[] = "App\Entity\\{$file->getFilenameWithoutExtension()}";
      }
    }

    return $options;
  }
}
