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
use ApiPlatform\Doctrine\Common\Filter\SearchFilterInterface;
use ApiPlatform\Doctrine\Common\Filter\SearchFilterTrait;
use ApiPlatform\Doctrine\Orm\Filter\AbstractFilter;
use ApiPlatform\Doctrine\Orm\Util\QueryBuilderHelper;
use ApiPlatform\Doctrine\Orm\Util\QueryNameGeneratorInterface;
use ApiPlatform\Metadata\Exception\InvalidArgumentException;
use ApiPlatform\Metadata\IdentifiersExtractorInterface;
use ApiPlatform\Metadata\IriConverterInterface;
use ApiPlatform\Metadata\Operation;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;
use Psr\Log\LoggerInterface;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\PropertyAccess\PropertyAccessorInterface;
use Symfony\Component\Serializer\NameConverter\NameConverterInterface;

/**
 * The search filter allows to filter a collection by given properties.
 *
 * The search filter supports `exact`, `partial`, `start`, `end`, and `word_start` matching strategies:
 * - `exact` strategy searches for fields that exactly match the value
 * - `partial` strategy uses `LIKE %value%` to search for fields that contain the value
 * - `start` strategy uses `LIKE value%` to search for fields that start with the value
 * - `end` strategy uses `LIKE %value` to search for fields that end with the value
 * - `word_start` strategy uses `LIKE value% OR LIKE % value%` to search for fields that contain words starting with the value
 *
 * Note: it is possible to filter on properties and relations too.
 *
 * Prepend the letter `i` to the filter if you want it to be case-insensitive. For example `ipartial` or `iexact`.
 * Note that this will use the `LOWER` function and *will* impact performance if there is no proper index.
 *
 * Case insensitivity may already be enforced at the database level depending on the [collation](https://en.wikipedia.org/wiki/Collation) used.
 * If you are using MySQL, note that the commonly used `utf8_unicode_ci` collation (and its sibling `utf8mb4_unicode_ci`)
 * are already case-insensitive, as indicated by the `_ci` part in their names.
 *
 * Note: Search filters with the `exact` strategy can have multiple values for the same property (in this case the
 * condition will be similar to a SQL IN clause).
 *
 * Syntax: `?property[]=foo&property[]=bar`.
 *
 * <div data-code-selector>
 *
 * ```php
 * <?php
 * // api/src/Entity/Book.php
 * use ApiPlatform\Metadata\ApiFilter;
 * use ApiPlatform\Metadata\ApiResource;
 * use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
 *
 * #[ApiResource]
 * #[ApiFilter(SearchFilter::class, properties: ['isbn' => 'exact', 'description' => 'partial'])]
 * class Book
 * {
 *     // ...
 * }
 * ```
 *
 * ```yaml
 * # config/services.yaml
 * services:
 *     book.search_filter:
 *         parent: 'api_platform.doctrine.orm.search_filter'
 *         arguments: [ { isbn: 'exact', description: 'partial' } ]
 *         tags:  [ 'api_platform.filter' ]
 *         # The following are mandatory only if a _defaults section is defined with inverted values.
 *         # You may want to isolate filters in a dedicated file to avoid adding the following lines (by adding them in the defaults section)
 *         autowire: false
 *         autoconfigure: false
 *         public: false
 *
 * # api/config/api_platform/resources.yaml
 * resources:
 *     App\Entity\Book:
 *         - operations:
 *               ApiPlatform\Metadata\GetCollection:
 *                   filters: ['book.search_filter']
 * ```
 *
 * ```xml
 * <?xml version="1.0" encoding="UTF-8" ?>
 * <!-- api/config/services.xml -->
 * <?xml version="1.0" encoding="UTF-8" ?>
 * <container
 *         xmlns="http://symfony.com/schema/dic/services"
 *         xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
 *         xsi:schemaLocation="http://symfony.com/schema/dic/services
 *         https://symfony.com/schema/dic/services/services-1.0.xsd">
 *     <services>
 *         <service id="book.search_filter" parent="api_platform.doctrine.orm.search_filter">
 *             <argument type="collection">
 *                 <argument key="isbn">exact</argument>
 *                 <argument key="description">partial</argument>
 *             </argument>
 *             <tag name="api_platform.filter"/>
 *         </service>
 *     </services>
 * </container>
 * <!-- api/config/api_platform/resources.xml -->
 * <resources
 *         xmlns="https://api-platform.com/schema/metadata/resources-3.0"
 *         xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
 *         xsi:schemaLocation="https://api-platform.com/schema/metadata/resources-3.0
 *         https://api-platform.com/schema/metadata/resources-3.0.xsd">
 *     <resource class="App\Entity\Book">
 *         <operations>
 *             <operation class="ApiPlatform\Metadata\GetCollection">
 *                 <filters>
 *                     <filter>book.search_filter</filter>
 *                 </filters>
 *             </operation>
 *         </operations>
 *     </resource>
 * </resources>
 * ```
 *
 * </div>
 *
 * @author Kévin Dunglas <dunglas@gmail.com>
 */
final class UserFilter extends OrFilter {

  public function __construct(ManagerRegistry $managerRegistry, IriConverterInterface|LegacyIriConverterInterface $iriConverter, ?PropertyAccessorInterface $propertyAccessor = null, ?LoggerInterface $logger = null, ?array $properties = null, IdentifiersExtractorInterface|LegacyIdentifiersExtractorInterface|null $identifiersExtractor = null, ?NameConverterInterface $nameConverter = null, protected array $dateFilterProperties = [], protected array $searchFilterProperties = []) {
    parent::__construct($managerRegistry, $iriConverter, $propertyAccessor, $logger, $properties, $identifiersExtractor, $nameConverter, $dateFilterProperties, $searchFilterProperties);
  }
  public function apply(QueryBuilder $queryBuilder, QueryNameGeneratorInterface $queryNameGenerator, string $resourceClass, ?Operation $operation = null, array $context = []): void {
    $this->properties = $this->searchFilterProperties;

    if (!empty($context['args']['nombre'])) {
      $context['args']['apellido'] = $context['args']['nombre'];
      $this->properties['apellido'] = 'ipartial';
    }
    foreach (array_filter($context['args'], fn($v) => $v) as $key => $value) {
      $this->filterProperty($key, $value, $queryBuilder, $queryNameGenerator, $resourceClass, $operation);
    };
  }
}
