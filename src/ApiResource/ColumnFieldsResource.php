<?php

namespace App\ApiResource;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\State\ProviderInterface;
use App\ApiResource\ResourceBase;
use ApiPlatform\Metadata\Operation;
use App\ApiResource\Form\CreateForm;
use App\Attribute\ColumnTableList;
use ReflectionClass;
use ReflectionProperty;

#[ApiResource(
  provider: ColumnFieldsResource::class,
  operations: [
    new Get(uriTemplate: '/column/fields/{className}')
  ]
)]
class ColumnFieldsResource extends ResourceBase implements ProviderInterface {


  public function __construct(private CreateForm $createForm) {
  }

  public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null {
    $className = ResourceBase::entityNameParse($uriVariables['className']);
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
