<?php

namespace App\FormKit;

use ApiPlatform\Metadata\IriConverterInterface;
use Doctrine\ORM\EntityManagerInterface;

class UserSchema extends FormKit {

  public $exclude = ['fullName', 'password', 'accessTokenScopes', 'roles', 'id', 'permisos',  'apiTokens'];

  public function __construct(protected ?string $className, protected ?EntityManagerInterface $entityManagerInterface, protected ?IriConverterInterface $iriConverter) {
    parent::__construct($this->className, $this->entityManagerInterface, $this->iriConverter);
  }
  public function schema(): array {
    return [
      [
        '$cmp' => 'Fieldset',
        'props' =>
        [
          'legend' => 'Datos Personales',
          'toggleable' => true,
          'style' => 'float: left'

        ],
        'children' =>
        [
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
        '$cmp' => 'Fieldset',
        'props' =>
        [
          'legend' => 'Cuenta',
          'toggleable' => true,
          'style' => 'float: left'
        ],
        'children' =>
        [
          'username',
          // 'status',
        ]

      ],
    ];
  }
}
