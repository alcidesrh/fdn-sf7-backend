<?php

namespace App\Resolver;

use ApiPlatform\GraphQl\Resolver\QueryItemResolverInterface;
use ApiPlatform\Metadata\IriConverterInterface;
use App\DTO\MetadataDto;
use App\Security\ABAC;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DependencyInjection\Attribute\Autowire;

use function Symfony\Component\String\u;

final class CreateFormResolver implements QueryItemResolverInterface {

  public function __construct(private ABAC $casbin, private EntityManagerInterface $entityManagerInterface, private IriConverterInterface $iriConverter, #[Autowire(param: 'formkit_path')] private string $formkit_path, #[Autowire(param: 'formkit_namespace')] private string $formkit_namespace) {
  }
  public function __invoke(?object $item, array $context): object {

    $className = u($context['args']['resource'])->camel()->title();
    $schemaClass = "{$className}Schema";
    $dirPath = $this->formkit_path . "/$schemaClass.php";

    $class = \file_exists($dirPath) ? "{$this->formkit_namespace}\\$schemaClass" : 'App\FormKit\FormKit';

    $schema = (new ($class)($className, $this->entityManagerInterface, $this->iriConverter))->getSchema();

    return new MetadataDto($schema);
  }
}
