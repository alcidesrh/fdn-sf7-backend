<?php

namespace App\Resolver;

use ApiPlatform\GraphQl\Resolver\QueryItemResolverInterface;
use ApiPlatform\Metadata\IriConverterInterface;
use App\FormKit\Schema;
use App\Repository\FormSchemaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DependencyInjection\Attribute\Autowire;

final class FormResourceResolver implements QueryItemResolverInterface {

  public function __construct(protected EntityManagerInterface $entityManager, protected IriConverterInterface $iriConverter, private FormSchemaRepository $repo, #[Autowire('%ENTITY_PATH%/')] private $entityPath) {
  }

  public function __invoke(?object $item, array $context): object {

    return (new Schema($this->entityManager, $this->iriConverter, $this->repo, \pathinfo($this->entityPath . $context['args']['entity'] . '.php')))->getSchema();
  }
}
