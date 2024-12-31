<?php

namespace App\Resolver;

use ApiPlatform\GraphQl\Resolver\QueryItemResolverInterface;
use App\ApiResource\ResourceBase;
use App\DTO\MetadataDto;
use App\FormKit\FormKit;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DependencyInjection\Attribute\Autowire;

use function Symfony\Component\String\u;

final class CreateFormResolver implements QueryItemResolverInterface {

  public function __construct(private EntityManagerInterface $entityManagerInterface, #[Autowire(param: 'formkit_path')] private string $formkit_path, #[Autowire(param: 'formkit_namespace')] private string $formkit_namespace) {
  }
  public function __invoke(?object $item, array $context): object {

    $className = u($context['args']['entity'])->camel()->title();
    $schemaClass = "{$className}Schema";
    $path = $this->formkit_path . "/$schemaClass.php";
    $data = (\file_exists($path) ?  new ("{$this->formkit_namespace}\\$schemaClass")($className, $this->entityManagerInterface) : new FormKit($className, $this->entityManagerInterface))->form();

    return new MetadataDto($data);

    $className = ResourceBase::entityNameParse($context['args']['entity']);
    $reflectionClass = new \ReflectionClass($className);
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
    $data = array_map(function (\ReflectionProperty $v) {

      return [
        'field' => $v->getName(),
        'label' => $v->getName()
      ];
    }, $reflectionClass->getProperties());


    return new MetadataDto($data);
  }
}
