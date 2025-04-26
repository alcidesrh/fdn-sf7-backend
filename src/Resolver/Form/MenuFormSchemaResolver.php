<?php

namespace App\Resolver\Form;

use ApiPlatform\GraphQl\Resolver\QueryItemResolverInterface;
use ApiPlatform\Metadata\IriConverterInterface;
use App\DTO\MetadataDto;
use App\FormKit\Schema;
use App\Security\ABAC;
use App\Services\FormkitReflection;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\DependencyInjection\ContainerBuilder;

use function Symfony\Component\String\u;

final class MenuFormSchemaResolver implements QueryItemResolverInterface {

  public function __construct(private ABAC $casbin, private Schema $schema) {
  }
  public function __invoke(?object $item, array $context): object {

    $this->schema->setSchemaClass($context['args']['resource']);

    // $className = u($context['args']['resource'])->camel()->title();
    // $schemaClass = "{$className}Schema";
    // $dirPath = $this->formkit_path . "/$schemaClass.php";

    // FormkitReflection::setEntityPath($className);
    // if (\file_exists($dirPath)) {
    //   $class = "{$this->formkit_namespace}\\$schemaClass";
    //   $schema = (new ($class)($className, $this->entityManagerInterface, $this->iriConverter))->getSchema();
    // }

    // $class = \file_exists($dirPath) ? "{$this->formkit_namespace}\\$schemaClass" : 'App\FormKit\FormKit';

    // $schema = (new ($class)($className, $this->entityManagerInterface, $this->iriConverter))->getSchema();

    return new MetadataDto($schema);
  }
}
