<?php

namespace App\Enum;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

abstract class AbstractEnumType extends Type {

  public function getSQLDeclaration(array $column, AbstractPlatform $platform): string {
    return "VARCHAR(255)";
    $enum = $this->getEnumsClass();
    $cases = array_map(
      fn ($enumItem) => "'{$enumItem->value}'",
      $enum::cases()
    );

    return sprintf('ENUM(%s)', implode(', ', $cases));
  }

  public function convertToDatabaseValue($value, AbstractPlatform $platform): mixed {
    if ($value instanceof BackedEnum) {
      return $value->value;
    }
    return null;
  }

  public function convertToPHPValue($value, AbstractPlatform $platform): mixed {
    if (false === \enum_exists($this::getEnumsClass(), true)) {
      throw new LogicException("This class should be an enum");
    }
    // 🔥 https://www.php.net/manual/en/backedenum.tryfrom.php
    return $this::getEnumsClass()::tryFrom($value);
  }

  abstract public static function getEnumsClass(): string;
}
