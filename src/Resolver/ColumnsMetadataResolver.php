<?php

namespace App\Resolver;

use ApiPlatform\GraphQl\Resolver\QueryItemResolverInterface;
use App\ApiResource\ResourceBase;
use App\Attribute\ColumnTableList;
use App\DTO\MetadataDTO;
use ReflectionClass;
use ReflectionProperty;
use Doctrine\ORM\EntityManagerInterface;

final class ColumnsMetadataResolver implements QueryItemResolverInterface {

  public function __construct(private EntityManagerInterface $entityManagerInterface) {
  }

  public function __invoke(?object $item, array $context): object {

    $className = ResourceBase::entityNameParse($context['args']['className']);

    $return = ['total' => $this->total($className), 'collection' => $this->collection($className)];

    $metadata = new MetadataDTO();
    $metadata->columns = ['total' => $this->total($className), 'collection' => $this->collection($className)];
    return $metadata; //[new CollectionMetadataDTO($return['total'], $return['collection'])];
    return ['total' => $this->total($className), 'collection' => $this->collection($className)];
  }

  public function total($className): int {

    $query = $this->entityManagerInterface->getRepository($className);
    if (!empty($data = $query->createQueryBuilder('u')->select('count(u.id)')->getQuery()->getResult())) {
      return  $data[0][1];
    }
    return 0;
  }


  public function collection($className): object|array|null {

    $reflectionClass = new ReflectionClass($className);
    if ($attrClass = $reflectionClass->getAttributes(ColumnTableList::class)) {

      $parse = function ($value) {
        if (!empty($data = explode('*', $value))) {
          $temp = ['field' => $data[0]];
          if (count($data) > 1) {
            for ($i = 1; $i < count($data); $i++) {
              if (!empty($temp3 = explode('=', $data[$i]))) {
                $temp[$temp3[0]] = $temp3[1] ?? true;
              }
            }
          }
        }
        return $temp;
      };
      $return = array_map($parse, $attrClass[0]->newInstance()->columns);
      return $return;
    }
    return array_map(function (ReflectionProperty $v) {

      return [
        'field' => $v->getName(),
        'label' => $v->getName()
      ];
    }, $reflectionClass->getProperties());
  }
}
