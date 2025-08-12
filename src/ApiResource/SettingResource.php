<?php

namespace App\ApiResource;

use ApiPlatform\GraphQl\Resolver\QueryItemResolverInterface;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GraphQl\Query;
use ApiPlatform\Metadata\GraphQl\QueryCollection;
use App\DTO\CollectionDTO;
use App\DTO\MetadataDTO;
use App\Resolver\EntityListResolver;
use App\Services\Collection;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;

interface ListInterface {

  public function getList(): array;
}

#[ApiResource(
  paginationEnabled: false,
  graphQlOperations: [
    new Query(
      name: 'entities',
      read: false,
      output: ListInterface::class,
      resolver: SettingResource::class,
      args: [],
      write: false,
      validate: false,
      queryParameterValidationEnabled: false
    ),
  ]
)]
class SettingResource implements QueryItemResolverInterface {

  private const EXCLUDE = ['ApiToken', 'FDN', 'FormSchema', 'Route', 'Taxon'];

  public function __construct(#[Autowire('%ENTITY_PATH%/')] private $entityPath) {
  }

  public function __invoke(?object $item, array $context): object {
    $finder = new Finder();
    $finder->files()->in($this->entityPath)->depth(0)->name('*.php')->sortByName();
    $aux = [];
    foreach (iterator_to_array($finder->getIterator()) as $key => $value) {
      if (in_array($value->getBasename('.php'), self::EXCLUDE)) {
        continue;
      }
      $aux[] = $value->getBasename('.' . $value->getExtension());
    }


    return  new class(
      $aux
    ) implements ListInterface {

      public function __construct(public array $list, public string $id = SettingResource::class) {
      }

      public function getList(): array {
        return $this->list;
      }
    };
  }
}
