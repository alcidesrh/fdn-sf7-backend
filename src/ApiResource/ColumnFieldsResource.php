<?php

namespace App\ApiResource;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use App\ApiResource\ResourceBase;
use App\Provider\ColumnFieldsProvider;

use function Symfony\Component\String\u;
use Doctrine\ORM\EntityManagerInterface;

#[ApiResource(
  provider: ColumnFieldsProvider::class,
  operations: [
    new Get(uriTemplate: '/column/fields/{className}')
  ]

)]
class ColumnFieldsResource extends ResourceBase {

  public function __construct(private EntityManagerInterface $entityManagerInterface) {
  }

  public function getForm(string $className) {
    $this->className = u($className)->camel()->title();
    return FormFactory::create($className)->setEntityManage($this->entityManagerInterface)->form();
  }
}
