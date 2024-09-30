<?php

namespace App\Types;

use ApiPlatform\GraphQl\Type\Definition\TypeInterface;
use GraphQL\Error\Error;
use GraphQL\Language\AST\StringValueNode;
use GraphQL\Type\Definition\InputObjectType;
use GraphQL\Type\Definition\ScalarType;
use GraphQL\Type\Definition\Type;
use GraphQL\Utils\Utils;

final class UserFilterType extends InputObjectType implements TypeInterface {
  public function __construct() {
    $this->name = 'UserFilter';
    $this->description = 'The `DateTime` scalar type represents time data.';

    parent::__construct(['name' => 'UserFilterType', 'fields' => ['nombre' => ['type' => Type::string()]]]);
  }

  public function getName(): string {
    return $this->name;
  }

  public function serialize($value) {
    // Already serialized.
    $stop = 0;


    return $value;
  }

  public function parseValue($value) {
    // if (!\is_string($value)) {
    //   throw new Error(sprintf('DateTime cannot represent non string value: %s', Utils::printSafeJson($value)));
    // }

    // if (false === \DateTime::createFromFormat(\DateTime::ATOM, $value)) {
    //   throw new Error(sprintf('DateTime cannot represent non date value: %s', Utils::printSafeJson($value)));
    // }

    // Will be denormalized into a \DateTime.
    return $value;
  }

  public function parseLiteral($valueNode, ?array $variables = null) {
    if ($valueNode instanceof StringValueNode) {
      return $valueNode->value;
    }

    // Intentionally without message, as all information already in wrapped Exception
    throw new \Exception();
  }
}
