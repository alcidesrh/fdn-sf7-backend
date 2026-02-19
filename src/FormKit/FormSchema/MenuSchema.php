<?php

namespace App\FormKit\FormSchema;

class MenuSchema {
  public $entitySchema = [
    [
      'div' => [
        'class' => 'form-row',
        'children' => [
          [
            'div' => [
              'class' => 'form-col',
              'children' => [
                '$el' => [
                  'type' => 'fieldset',
                  'children' => [
                    '$el' => [
                      'type' => 'legend',
                      'children' => 'Datos generales'
                    ],
                    'div' => [
                      'children' => [
                        'icon',
                        'action',
                        'nombre',
                        'posicion',
                        'tipo',
                        'status',
                      ]
                    ]
                  ],
                ]
              ]
            ]
          ],
          [
            'div' => [
              'class' => 'form-col',
              'children' => [
                '$el' => [
                  'type' => 'fieldset',
                  'children' => [
                    '$el' => [
                      'type' => 'legend',
                      'children' => 'Menus relacionados'
                    ],
                    'div' => [
                      'children' => [
                        'parent',
                        'children'
                      ]
                    ]
                  ]
                ]

              ]
            ]
          ],
        ]
      ]
    ],
  ];
}
