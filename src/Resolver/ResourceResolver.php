<?php

namespace App\Resolver;

use ApiPlatform\GraphQl\Resolver\QueryItemResolverInterface;
use App\DTO\ResourceDTO;
use Doctrine\ORM\EntityManagerInterface;

final class ResourceResolver implements QueryItemResolverInterface {

  public function __construct(private EntityManagerInterface $entityManagerInterface) {
  }
  /**
   */
  public function __invoke($item, array $context): object {


    ['entity' => $entity, 'field' => $field, 'value' => $value] =  $context['args'];

    $resource =  new ResourceDTO();

    switch ($entity) {
      case 'User':
        $resource->user = $this->entityManagerInterface->getRepository("App\\Entity\\$entity")->findOneBy([$field => $value]);
        break;
      case 'Estacion':
        $resource->estacion = $this->entityManagerInterface->getRepository("App\\Entity\\$entity")->findOneBy([$field => $value]);
        break;
      default:
        # code...
        break;
    }
    // $resource->resource = $this->entityManagerInterface->getRepository("App\\Entity\\$entity")->findOneBy([$field => $value]);
    return $resource; //$this->entityManagerInterface->getRepository("App\\Entity\\$entity")->findOneBy([$field => $value]);
  }
}
