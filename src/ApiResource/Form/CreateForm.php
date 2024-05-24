<?php

namespace App\ApiResource\Form;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use function Symfony\Component\String\u;
use App\Provider\FormStateProvider;
use Doctrine\ORM\EntityManagerInterface;

#[ApiResource(
  shortName: 'create_form',
  provider: FormStateProvider::class,
  operations: [
    new Get()
  ]

)]
class CreateForm {

  private string $className;

  public function __construct(private EntityManagerInterface $entityManagerInterface) {
  }

  public function getForm(string $className) {
    $this->className = u($className)->camel()->title();
    return FormFactory::create($className)->setEntityManage($this->entityManagerInterface)->form();
  }

  #[ApiProperty(identifier: true, readable: false)]
  public function getClassName(): string {
    return $this->className;
  }
}
