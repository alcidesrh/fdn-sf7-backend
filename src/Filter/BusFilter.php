<?php

/*
 * This file is part of the API Platform project.
 *
 * (c) Kévin Dunglas <dunglas@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace App\Filter;

use ApiPlatform\Api\IdentifiersExtractorInterface as LegacyIdentifiersExtractorInterface;
use ApiPlatform\Api\IriConverterInterface as LegacyIriConverterInterface;
use ApiPlatform\Doctrine\Orm\Util\QueryNameGeneratorInterface;
use ApiPlatform\Metadata\IdentifiersExtractorInterface;
use ApiPlatform\Metadata\IriConverterInterface;
use ApiPlatform\Metadata\Operation;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;
use Psr\Log\LoggerInterface;
use Symfony\Component\PropertyAccess\PropertyAccessorInterface;
use Symfony\Component\Serializer\NameConverter\NameConverterInterface;

final class BusFilter extends OrFilter {

  public function __construct(ManagerRegistry $managerRegistry, IriConverterInterface|LegacyIriConverterInterface $iriConverter, ?PropertyAccessorInterface $propertyAccessor = null, ?LoggerInterface $logger = null, ?array $properties = null, IdentifiersExtractorInterface|LegacyIdentifiersExtractorInterface|null $identifiersExtractor = null, ?NameConverterInterface $nameConverter = null, protected array $dateFilterProperties = [], protected array $searchFilterProperties = []) {
    parent::__construct($managerRegistry, $iriConverter, $propertyAccessor, $logger, $properties, $identifiersExtractor, $nameConverter, $dateFilterProperties, $searchFilterProperties);
  }
  public function apply(QueryBuilder $queryBuilder, QueryNameGeneratorInterface $queryNameGenerator, string $resourceClass, ?Operation $operation = null, array $context = []): void {

    $this->properties = $this->searchFilterProperties;

    foreach (array_filter($context['args'], fn($v) => $v) as $key => $value) {
      $this->filterProperty($key, $value, $queryBuilder, $queryNameGenerator, $resourceClass, $operation);
    };
  }
}
