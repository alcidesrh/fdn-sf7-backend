<?php

namespace App\Resolver;

use ApiPlatform\GraphQl\Resolver\QueryItemResolverInterface;
use App\ApiResource\ResourceBase;
use App\Attribute\ColumnTableList;
use App\DTO\MetadataDTO;
use App\Enum\Status;
use ReflectionClass;
use ReflectionProperty;
use Doctrine\ORM\EntityManagerInterface;

final class ColumnsMetadataResolver implements QueryItemResolverInterface {



  public function __construct(private EntityManagerInterface $entityManagerInterface, private ?ReflectionClass $reflectionClass) {
  }

  public function __invoke(?object $item, array $context): object {

    $className = ResourceBase::entityNameParse($context['args']['entity']);

    $metadata = new MetadataDTO();
    $metadata->data = ['collection' => $this->collection($className)];
    return $metadata; //[new CollectionMetadataDTO($return['total'], $return['collection'])];
  }

  public function total($className): int {

    $query = $this->entityManagerInterface->getRepository($className);
    if (!empty($data = $query->createQueryBuilder('u')->select('count(u.id)')->getQuery()->getResult())) {
      return  $data[0][1];
    }
    return 0;
  }


  public function collection($className): object|array|null {

    $this->reflectionClass = new ReflectionClass($className);
    if ($attrClass = $this->reflectionClass->getAttributes(ColumnTableList::class)) {
      $metadata = $attrClass[0]->newInstance()->columns;
      $data = [];
      foreach ($metadata as $value) {
        if ((\is_array($value) && !empty($value['filter']))) {
          $schema = $this->getSchema($value);
          $data[] = [...$value, 'schema' => $schema];
        } else {
          $data[] = $value;
        }
      }

      return $data;
    }
    return array_map(function (ReflectionProperty $v) {

      return [
        'field' => $v->getName(),
        'label' => $v->getName()
      ];
    }, $this->reflectionClass->getProperties());
  }
  public function getSchema(&$data) {

    $temp = $this->reflectionClass->getProperty($data['name']);
    $type = $temp->getType()->getName();
    $schema = ['$formkit' => 'texticon_fdn', 'name' => $data['name'], 'placeholder' => $data['label'] ?? $data['name'], 'loading' => '$loading'];
    if (isset($data['outerClass'])) {
      $schema['outerClass'] = $data['outerClass'];
      unset($data['outerClass']);
    }
    if (isset($data['inputClass'])) {
      $schema['inputClass'] = $data['inputClass'];
      unset($data['inputClass']);
    }

    $schema = match ($type) {
      in_array($type, ['string', 'int', Status::class]) ? $type : false => $schema,
      'DateTime' => [...$schema, '$formkit' => 'datepicker_fdn', 'selectionMode' => 'range', 'hourFormat' => 12, 'showTime' => true],
      'DateTimeInterface' => [...$schema, '$formkit' => 'datepicker_fdn', 'selectionMode' => 'range', 'hourFormat' => 12, 'showTime' => true],
    };

    return $schema;
  }
}
