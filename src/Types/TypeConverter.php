<?php

namespace App\Types;

use ApiPlatform\GraphQl\Type\TypeConverterInterface;
use ApiPlatform\Metadata\GraphQl\Operation;
use App\Entity\Book;
use GraphQL\Type\Definition\Type as GraphQLType;
use Symfony\Component\PropertyInfo\Type;

final class TypeConverter implements TypeConverterInterface {
  private $defaultTypeConverter;

  public function __construct(TypeConverterInterface $defaultTypeConverter) {
    $this->defaultTypeConverter = $defaultTypeConverter;
  }

  public function convertType(Type $type, bool $input, Operation $rootOperation, string $resourceClass, string $rootResource, ?string $property, int $depth): GraphQLType|string|null {
    if (
      'publicationDate' === $property
      && Book::class === $rootResource
    ) {
      return 'DateTime';
    }

    return $this->defaultTypeConverter->convertType($type, $input, $rootOperation, $resourceClass, $rootResource, $property, $depth);
  }

  public function resolveType(string $type): ?GraphQLType {
    return $this->defaultTypeConverter->resolveType($type);
  }
}
