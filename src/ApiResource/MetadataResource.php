<?php

namespace App\ApiResource;

use Doctrine\ORM\EntityManagerInterface;
use App\ApiResource\ResourceBase;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GraphQl\Query;
use ApiPlatform\Metadata\GraphQl\QueryCollection;
use App\DTO\CollectionMetadataDTO;
use App\DTO\MetadataDTO;
use App\Resolver\ColumnsMetadataResolver;
use App\Resolver\MetadataResolver;
use DateTime;

#[ApiResource(
  operations: [
    new Get(
      // shortName: 'metadata',
      provider: MetadataResource::class,
      uriTemplate: '/metadata/{className}'
    )
  ],

  graphQlOperations: [
    new Query(
      name: 'get',
      resolver: MetadataResolver::class,
      read: false,
      output: MetadataDTO::class,
      args: [
        'status' => ['type' => 'Boolean'],
      ]
    ),
    new Query(
      name: 'columns',
      resolver: ColumnsMetadataResolver::class,
      read: false,
      output: MetadataDTO::class,
      args: [
        'className' => ['type' => 'String'],
      ]
    ),
  ]
)]
class MetadataResource {

  public \DateTimeInterface $date;

  public function __construct(private EntityManagerInterface $entityManagerInterface) {
    $this->date = new DateTime();
  }

  #[ApiProperty(identifier: true)]
  public function getDate(): string {
    return $this->date->format('Ymdms');
  }


  // public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null {

  //   $className = ResourceBase::entityNameParse($uriVariables['className']);

  //   return ['total' => $this->total($className), 'collection' => $this->collection($className)];
  // }

  // public function total($className): int {

  //   $query = $this->entityManagerInterface->getRepository($className);
  //   if (!empty($data = $query->createQueryBuilder('u')->select('count(u.id)')->getQuery()->getResult())) {
  //     return  $data[0][1];
  //   }
  //   return 0;
  // }


  // public function collection($className): object|array|null {

  //   $reflectionClass = new ReflectionClass($className);
  //   if ($attrClass = $reflectionClass->getAttributes(ColumnTableList::class)) {

  //     $parse = function ($value) {
  //       if (!empty($data = explode('*', $value))) {
  //         $temp = ['field' => $data[0]];
  //         if (count($data) > 1) {
  //           for ($i = 1; $i < count($data); $i++) {
  //             if (!empty($temp3 = explode('=', $data[$i]))) {
  //               $temp[$temp3[0]] = $temp3[1] ?? true;
  //             }
  //           }
  //         }
  //       }
  //       return $temp;
  //     };
  //     $return = array_map($parse, $attrClass[0]->newInstance()->columns);
  //     return $return;
  //   }
  //   return array_map(function (ReflectionProperty $v) {

  //     return [
  //       'field' => $v->getName(),
  //       'label' => $v->getName()
  //     ];
  //   }, $reflectionClass->getProperties());
  // }

  // public function getStatus(): array {
  //   return $this->status;
  // }
}
