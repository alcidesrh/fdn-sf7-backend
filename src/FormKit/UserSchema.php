<?php

namespace App\FormKit;

use Doctrine\ORM\EntityManagerInterface;

class UserSchema extends FormKit {

  public $exclude = ['fullName', 'password', 'accessTokenScopes', 'roles', 'id', 'permisos', 'status', 'apiTokens'];

  public function __construct(protected ?string $className, protected ?EntityManagerInterface $entityManagerInterface) {
    parent::__construct($this->className, $this->entityManagerInterface);
  }
  public function schema(): array {
    return [
      // [
      // '$el' => 'div',
      // 'attrs' => [
      // 'class' => 'flex gap-4'
      // ],
      // 'children' => [


      // [
      //   '$cmp' => 'Fieldset',
      //   'props' =>
      //   [
      //     'legend' => 'Roles & Privilegios',
      //     'toggleable' => true,
      //     'style' => 'float: left'
      //   ],
      //   'children' =>
      //   [
      //     'permisos',
      //     'apiTokens',

      //   ]
      // ],
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
