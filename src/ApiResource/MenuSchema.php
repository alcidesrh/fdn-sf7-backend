<?php

namespace App\ApiResource;

use ApiPlatform\GraphQl\Resolver\QueryItemResolverInterface;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GraphQl\Query;
use App\FormKit\EntitySchemaBase;
use App\FormKit\SchemaInterface;

#[ApiResource(

  graphQlOperations: [
    new Query(
      name: 'get',
      resolver: MenuSchema::class,
      output: SchemaInterface::class,
      read: false,
      args: []
    )
  ]
)]
class MenuSchema extends EntitySchemaBase implements QueryItemResolverInterface {

  public $entitySchema = [
    'form' => [
      'props' => ['name' => 'menuForm'],
      'children' => [
        [
          'div' => [
            'props' => ['class' => '$twoColumnClass'],
            'children' => [
              [
                'fieldset' => [
                  'props' => [
                    'legend' => 'Datos generales',
                    'style' => 'max-width: 25em'
                  ],
                  'children' => [
                    ['div' => [
                      'children' => [
                        'icon',
                        'nombre',
                        'link',
                        'posicion',
                        'tipo',
                        'status',
                        'nota'
                      ]
                    ]]
                  ],

                ],
              ],
              [
                'div' => [
                  'children' => [
                    [
                      'fieldset' => [
                        'props' => [
                          'legend' => 'Menus relacionados',
                          'style' => 'margin-bottom: 20px; width: 648px;',

                        ],
                        'children' => [
                          'parent',
                          'children'
                        ]
                      ],
                    ],
                    [
                      'fieldset' => [
                        'props' => [
                          'legend' => 'Permisos',
                          'style' => 'width: 648px;'
                        ],
                        'children' => [
                          [
                            'accordion' => [
                              'children' => [[
                                'picklist' => [
                                  'props' => [
                                    'name' => "roles",
                                    'icon' => 'material-symbols:person-off-outline',
                                    'options' => '$roles',
                                    'allowItems' => '$allowRoles',
                                    'field' => 'roles'
                                  ]
                                ]
                              ]]
                            ]
                          ],
                          [
                            'accordion' => [
                              'props' => ['label' => 'Usuarios permitidos', 'icon' => 'material-symbols:person-add-outline-rounded'],
                              'children' => [[
                                'picklist' => [
                                  'props' => [
                                    'name' => "allowUsers",
                                    'options' => '$users',
                                    'allowItems' => '$allowUsers',
                                    'icon' => 'icon-park-outline:every-user',
                                    'field' => 'allowUsers',
                                  ]
                                ]
                              ]]
                            ]
                          ],
                          [
                            'accordion' => [
                              'props' => ['label' => 'Usuarios no permitido', 'icon' => 'material-symbols:person-off-outline-rounded'],
                              'children' => [[
                                'picklist' => [
                                  'props' => [
                                    'name' => "denyUsers",
                                    'options' => '$users',
                                    'allowItems' => '$denyUsers',
                                    'field' => 'denyUsers'
                                  ]
                                ]
                              ]]
                            ]
                          ],
                          [
                            'accordion' => [
                              'props' => ['label' => 'Permisos', 'icon' => 'mdi:lock-open-variant-outline'],
                              'children' => [
                                ['picklist' => [
                                  'props' => [
                                    'name' => "permisos",
                                    'options' => '$permisos',
                                    'allowItems' => '$allowPermisos',
                                    'field' => 'alowPermisos'
                                  ]
                                ]]
                              ]
                            ]
                          ]
                        ],
                      ]
                    ]
                  ]
                ]
              ]
            ]
          ]
        ]
      ]
    ]
  ];


  public function __invoke(?object $item, array $context): object {


    return $this->entitySchema getShema('Menu');
  }
}
