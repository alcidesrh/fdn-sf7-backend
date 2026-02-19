<?php

namespace App\ApiResource;

use ApiPlatform\GraphQl\Resolver\QueryItemResolverInterface;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GraphQl\Query;
use ApiPlatform\Metadata\IriConverterInterface;
use App\FormKit\Schema;
use App\FormKit\SchemaInterface;
use App\Repository\FormSchemaRepository;
use App\Resolver\FormResourceResolver;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DependencyInjection\Attribute\Autowire;

#[ApiResource(
  graphQlOperations: [
    new Query(
      name: 'get',
      resolver: FormResourceResolver::class,
      output: SchemaInterface::class,
      read: false,
      args: [
        'entity' => ['type' => 'String'],
      ]
    )
  ]
)]
class FormResource implements QueryItemResolverInterface {

  public function __construct(protected EntityManagerInterface $entityManager, protected IriConverterInterface $iriConverter, private FormSchemaRepository $repo,  #[Autowire('%ENTITY_PATH%/')]
  private string $entityPath) {
  }

  public function __invoke(?object $item, array $context): object {

    return (new Schema($this->entityManager, $this->iriConverter, $this->repo, \pathinfo($this->entityPath . $context['args']['entity'] . '.php')))->getSchema();
  }
}
