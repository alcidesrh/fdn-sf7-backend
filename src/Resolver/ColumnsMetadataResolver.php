<?php

namespace App\Resolver;

use ApiPlatform\GraphQl\Resolver\QueryItemResolverInterface;
use App\Attribute\CollectionMetadataAttribute;
use App\DTO\MetadataDTO;
use App\Enum\Status;
use App\FormKit\Schema;
use App\Services\Reflection;
use ReflectionProperty;
use Doctrine\ORM\EntityManagerInterface;

final class ColumnsMetadataResolver implements QueryItemResolverInterface {


  const FORMKIT = [
    'int' => 'number',
    'string' => 'text',
    'DateTime' => 'datepicker',
    'DateTimeInterface' => 'datepicker',
    Status::class => 'selecticon',
  ];


  public function __construct(private EntityManagerInterface $entityManagerInterface) {
  }

  public function __invoke(?object $item, array $context): object {
    return new MetadataDTO($this->collection($context['args']['resource']));
  }

  public function collection($className): object|array|null {

    $reflection = new Reflection($className);
    $filter = false;
    if ($attrClass = $reflection->reflection->getAttributes(CollectionMetadataAttribute::class)) {
      $metadata = $attrClass[0]->newInstance()->data;
      $class = $metadata['class'] ?? null;
      $data = [];
      foreach ($metadata['props'] as $value) {
        $value['field'] = $value['name'];
        if ($class) {
          $value['class'] = isset($value['class']) ? $class . ' ' . $value['class'] : $class;
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

      $collection = $reflection->properties->map(fn(ReflectionProperty $v) => ['name' => $v->getName(), 'class' => 'col-wraper' . ($v->getName() == 'id' ? ' col-small' : '')]);

      if ($temp = $collection->findFirstKeyAndValue(fn($i, $v) => $v['name'] == 'id')) {

        $data = [$collection->get($temp['key']), ...$collection->filter(fn($v) => $v['name'] != 'id')->toArray()];
      } else {
        $data = [...$collection->getValues()];
      }
    }

    return ['collection' => $data, 'filter' => $filter];
  }
  public function getSchema(&$data, ReflectionProperty $reflection) {

    $type = $reflection->getType()->getName();
    $schema = ['$formkit' => self::FORMKIT[$type], 'name' => $data['name'], 'loading' => '$loading', ...['outerClass' => \join(' ', ['mb-0! px-0!',  $data['outerClass'] ?? ''])]];

    $data['class'] = \join(' ', [$data['class'] ?? '', $data['columnClass'] ?? '']);

    $schema = Schema::input($type, $schema);

    return $schema;
  }
}
