<?php
// api/src/Resolver/BookCollectionResolver.php
namespace App\Resolver;

use ApiPlatform\GraphQl\Resolver\QueryCollectionResolverInterface;
use App\Entity\IconCategory;

final class IconCategoryCollectionResolver implements QueryCollectionResolverInterface {
  /**
   * @param iterable<IconCategory> $collection
   *
   * @return iterable<IconCategory>
   */
  public function __invoke(iterable $collection, array $context): iterable {
    // Query arguments are in $context['args'].

    foreach ($collection as $iconCategory) {
      // Do something with the book.
    }

    return $collection;
  }
}
