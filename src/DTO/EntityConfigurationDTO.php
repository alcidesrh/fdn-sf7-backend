<?php

namespace App\DTO;

use App\Entity\Configuration\EntityConfiguration;
use Symfony\Component\ObjectMapper\Attribute\Map;

#[Map(source: EntityConfiguration::class)]
final class EntityConfigurationDTO {
  #[Map(source: 'id')]
  public int $id;

  #[Map(source: 'entityClass')]
  public string $name;
}
