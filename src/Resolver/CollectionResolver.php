<?php

namespace App\Resolver;

use ApiPlatform\GraphQl\Resolver\QueryCollectionResolverInterface;
use ApiPlatform\GraphQl\Resolver\QueryItemResolverInterface;
use ApiPlatform\Metadata\IriConverterInterface;
use App\ApiResource\ResourceBase;
use App\DTO\MetadataDTO;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;

final class CollectionResolver implements QueryItemResolverInterface {

  public function __construct(private EntityManagerInterface $entityManagerInterface, private IriConverterInterface $iriConverter) {
  }
  /**
   */
  public function __invoke(?object $item, array $context): object {
    $metadata = new MetadataDTO();
    $metadata->data = ['collection' => (new ArrayCollection($this->entityManagerInterface->getRepository(ResourceBase::entityNameParse($context['args']['resource']))->findAll()))->map(fn($v) => ['value' => $this->iriConverter->getIriFromResource($v), 'label' => $v->getLabel()])];

    return $metadata;
  }
}
