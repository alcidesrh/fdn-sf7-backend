<?php

namespace App\FormKit;

use ApiPlatform\Metadata\IriConverterInterface;
use Doctrine\ORM\EntityManagerInterface;


class UserSchema extends FormKit {

  public array $exclude = ['fullName', 'password', 'accessTokenScopes', 'roles', 'permisos',  'apiTokens'];

  protected array $schema = [
    [
      'wrapper' => true,
      'type' => 'Fieldset',
      'props' =>
      [
        'legend' => 'Datos Personales',
        'toggleable' => true,
        'style' => 'float: left',
        'id' => 'datos_personales'
      ],
      'children' => [
        ['field' => 'nit', 'outerClass' => 'fdn-input-short'],
        'nombre',
        'apellido',
        'email',
        'telefono',
        'direccion',
        'localidad'
      ]
    ],
    [
      'wrapper' => true,
      'type' => 'Fieldset',
      'props' =>
      [
        'legend' => 'Cuenta',
        'toggleable' => true,
        'id' => 'cuenta'
      ],

      'children' =>
      [
        'username',
        'status',
      ]

    ],
  ];

  public function __construct(protected ?string $className, protected ?EntityManagerInterface $entityManagerInterface, protected ?IriConverterInterface $iriConverter) {
    parent::__construct($this->className, $this->entityManagerInterface, $this->iriConverter);
  }
  // public function schema(): array {

  // }
}
