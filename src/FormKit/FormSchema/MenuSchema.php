<?php

namespace App\FormKit\FormSchema;

class MenuSchema {
  public $entitySchema = [
    'form' => [
      'props' => ['name' => 'menuForm'],
      'children' => [
        [
          'div' => [
            'props' => ['class' => 'form-flex', 'style' => 'max-width: 60em'],
            'children' => [
              [
                'fieldset' => [
                  'props' => [
                    'legend' => 'Datos generales',
                    // 'style' => 'max-width: 25em',
                    'class' => 'form-column'
                  ],
                  'children' => [
                    ['div' => [
                      'children' => [
                        'icon',
                        'action',
                        'nombre',
                        'posicion',
                        'tipo',
                        'status',
                      ]
                    ]]
                  ],

                ],
              ],
              [
                'fieldset' => [
                  'props' => [
                    'legend' => 'Menus relacionados',
                    'class' => 'form-column'

                  ],
                  'children' => [
                    'parent',
                    'children'
                  ]
                ],
              ]
            ]
          ]
        ]
      ]
    ]
  ];
}

// [
                    //   'fieldset' => [
                    //     'props' => [
                    //       'legend' => 'Permisos',
                    //       'style' => 'width: 648px;'
                    //     ],
                    //     'children' => [
                    //       [
                    //         'accordion' => [
                    //           'props' => ['label' => 'Roles', 'icon' => 'icon-park-twotone:people-safe'],
                    //           'children' => [[
                    //             'picklist' => [
                    //               'props' => [
                    //                 'name' => "roles",
                    //                 'options' => '$roles',
                    //                 'allowItems' => '$allowRoles',
                    //                 'field' => 'roles'
                    //               ]
                    //             ]
                    //           ]]
                    //         ]
                    //       ],
                    //       [
                    //         'accordion' => [
                    //           'props' => ['label' => 'Usuarios permitidos', 'icon' => 'material-symbols:person-add-outline-rounded'],
                    //           'children' => [[
                    //             'picklist' => [
                    //               'props' => [
                    //                 'name' => "allowUsers",
                    //                 'options' => '$users',
                    //                 'allowItems' => '$allowUsers',
                    //                 'field' => 'allowUsers',
                    //               ]
                    //             ]
                    //           ]]
                    //         ]
                    //       ],
                    //       [
                    //         'accordion' => [
                    //           'props' => ['label' => 'Usuarios no permitido', 'icon' => 'material-symbols:person-off-outline-rounded'],
                    //           'children' => [[
                    //             'picklist' => [
                    //               'props' => [
                    //                 'name' => "denyUsers",
                    //                 'options' => '$users',
                    //                 'allowItems' => '$denyUsers',
                    //                 'field' => 'denyUsers'
                    //               ]
                    //             ]
                    //           ]]
                    //         ]
                    //       ],
                    //       [
                    //         'accordion' => [
                    //           'props' => ['label' => 'Permisos', 'icon' => 'mdi:lock-open-variant-outline'],
                    //           'children' => [
                    //             ['picklist' => [
                    //               'props' => [
                    //                 'name' => "permisos",
                    //                 'options' => '$permisos',
                    //                 'allowItems' => '$allowPermisos',
                    //                 'field' => 'alowPermisos'
                    //               ]
                    //             ]]
                    //           ]
                    //         ]
                    //       ]
                    //     ],
                    //   ]
                    // ]
