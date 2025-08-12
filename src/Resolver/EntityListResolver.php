<?php

namespace App\Resolver;

use ApiPlatform\GraphQl\Resolver\QueryCollectionResolverInterface;
use ApiPlatform\GraphQl\Resolver\QueryItemResolverInterface;
use ApiPlatform\Metadata\IriConverterInterface;
use App\DTO\CollectionDTO;

use function Symfony\Component\String\u;
use App\DTO\MetadataDTO;
use App\Services\Collection;
use App\Useful\Doctrine;
use Doctrine\Common\Collections\ArrayCollection;
use SplFileInfo;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\Finder\Finder;

final class EntityListResolver implements QueryItemResolverInterface {

  public function __construct(#[Autowire('%ENTITY_PATH%/')] private $entityPath) {
  }
  /**
   */
  public function __invoke(?object $item, array $context): object {

    $finder = new Finder();
    $finder->files()->in($this->entityPath)->depth(0)->name('*.php')->sortByName();
    $temp = (new Collection(iterator_to_array($finder->getIterator())))->map(fn(SplFileInfo $v) => $v->getBasename('.' . $v->getExtension()));

    $c = new MetadataDTO();
    $c->data = $temp->toArray();

    return $c; //ollection;
    $metadata = new MetadataDTO();
    $metadata->data = ['collection' => (new ArrayCollection($this->entityManagerInterface->getRepository(Doctrine::entityNamespace($context['args']['resource']))->findAll()))->map(fn($v) => ['value' => $this->iriConverter->getIriFromResource($v), 'label' => $v->getLabel()])];

    return $metadata;
  }
}
