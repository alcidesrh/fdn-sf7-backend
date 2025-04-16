<?php

namespace App\Resolver;

use ApiPlatform\GraphQl\Resolver\QueryItemResolverInterface;
use App\ApiResource\ResourceBase;
use App\Attribute\ColumnTableList;
use App\DTO\MetadataDTO;
use App\Enum\Status;
use App\Services\Collection;
use App\Services\Reflection;
use ReflectionClass;
use ReflectionProperty;
use Doctrine\ORM\EntityManagerInterface;

final class ColumnsMetadataResolver implements QueryItemResolverInterface {



  public function __construct(private EntityManagerInterface $entityManagerInterface) {
  }

  public function __invoke(?object $item, array $context): object {

    // $className = ResourceBase::entityNameParse($context['args']['resource']);

    return new MetadataDTO($this->collection($context['args']['resource']));
  }

  public function collection($className): object|array|null {

    $reflection = new Reflection($className);
    $filter = false;
    if ($attrClass = $reflection->classAttribute(ColumnTableList::class)) {
      $metadata = $attrClass[0]->newInstance()->columns;
      if ($classes = $metadata['classes'] ?? null) {
        unset($metadata['classes']);
      }
      $data = [];
      foreach ($metadata as $value) {
        if ($classes) {
          $value['class'] = isset($value['class']) ? $classes . ' ' . $value['class'] : $classes;
        }
        if ((\is_array($value) && !empty($value['filter']))) {
          $schema = $this->getSchema($value, $reflection->reflection->getProperty($value['name']));
          $data[] = [...$value, 'schema' => $schema];
          $filter = true;
        } else {
          $data[] = $value;
        }
      }
    } else {

      // $properties = new Collection($reflection->getProperties());

      $collection = $reflection->properties->map(fn(ReflectionProperty $v) => ['name' => $v->getName(), 'class' => 'columns-wraper' . ($v->getName() == 'id' ? ' small-column' : '')]);

      if ($temp = $collection->findFirstKeyAndValue(fn($i, $v) => $v['name'] == 'id')) {

        $data = [$collection->get($temp['key']), ...$collection->filter(fn($v) => $v['name'] != 'id')->toArray()];
      } else {
        $data = [...$collection->getValues()];
      }
      // foreach ($collection->getValues() as $key => $value) {
      //   $data[] = $value;
      // }
      // $data = $data->toArray();
      // $data = array_map(function (ReflectionProperty $v) {

      //   return [
      //     'name' => $v->getName(),
      //     'label' => $v->getName()
      //   ];
      // }, $reflection->getProperties());
    }


    return ['collection' => $data, 'filter' => $filter];
  }
  public function getSchema(&$data, ReflectionProperty $reflection) {

    $type = $reflection->getType()->getName();
    $schema = ['$formkit' => 'texticon_fdn', 'name' => $data['name'], 'placeholder' => $data['label'] ?? $data['name'], 'loading' => '$loading'];

    $schema['bind'] = [...$data['bind'] ?? [], ...['outerClass' => \join(' ', ['mb-0!',  $data['bind']['outerClass'] ?? ''])]];

    if ($data['name'] == 'id') {
      $data['class'] = \join(' ', [$data['class'] ?? '', 'small-column']);

      $schema['bind'] = [...$schema['bind'] ?? [], ...['outerClass' => \join(' ', ['small-column-id', $schema['bind']['outerClass']])]];
    }
    $schema = match ($type) {
      in_array($type, ['string', 'int', Status::class]) ? $type : false => $schema,
      'DateTime' => [...$schema, '$formkit' => 'datepicker_fdn', 'selectionMode' => 'range', 'hourFormat' => 12, 'showTime' => true],
      'DateTimeInterface' => [...$schema, '$formkit' => 'datepicker_fdn', 'selectionMode' => 'range', 'hourFormat' => 12, 'showTime' => true],
    };

    return $schema;
  }
}
