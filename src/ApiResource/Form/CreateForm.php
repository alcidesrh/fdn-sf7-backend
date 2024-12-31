<?php

namespace App\ApiResource\Form;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use App\FormKit\Form;
use App\FormKit\FormKit;

use function Symfony\Component\String\u;
use App\Provider\FormStateProvider;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DependencyInjection\Attribute\Autowire;

#[ApiResource(
  shortName: 'create_form',
  provider: FormStateProvider::class,
  operations: [
    new Get()
  ]

)]
class CreateForm {

  private string $className;

  public function __construct(private EntityManagerInterface $entityManagerInterface, #[Autowire(param: 'formkit_path')] private string $formkit_path, #[Autowire(param: 'formkit_namespace')] private string $formkit_namespace) {
  }

  public function getForm(string $className) {
    $this->className = u($className)->camel()->title();
    $schemaClass = "{$this->className}Schema";
    $path = $this->formkit_path . "/$schemaClass.php";
    return (\file_exists($path) ?  new ("{$this->formkit_namespace}\\$schemaClass")($this->className, $this->entityManagerInterface) : new FormKit($this->className, $this->entityManagerInterface))->form();
  }

  #[ApiProperty(identifier: true, readable: false)]
  public function getClassName(): string {
    return $this->className;
  }
}
