<?php

namespace App\FormKit;

use ApiPlatform\Metadata\IriConverterInterface;
use App\FormKit\Inputs\Component;
use App\FormKit\Inputs\Form;
use App\FormKit\Inputs\Html;
use App\FormKit\Inputs\Picklist;
use App\FormKit\Inputs\Text;
use Doctrine\ORM\EntityManagerInterface;

class MenuSchema extends Schema {

  public function __construct(?string $className, ?EntityManagerInterface $entityManagerInterface, ?IriConverterInterface $iriConverter) {
    parent::__construct($className, $entityManagerInterface, $iriConverter);

    $form = Form::create('nombre');

    // $form
    //   ->html(args: ['class' => 'toast-grid'])
    //   ->html(args: ['class' => 'grid__col grid__col--1-of-2 '])
    //   ->children(
    //     [
    //       'icon',
    //       'nombre',
    //       'link',
    //       'posicion',
    //       'tipo',
    //       'status',
    //       'nota'
    //     ]
    //   )
    //   ->ascend()
    //   ->html(args: ['class' => 'toast-grid'])
    //   ->fieldset(args: [
    //     'legend' => 'Permisos',
    //     'toggleable' => true,
    //     'style' => 'float: left; min-width: 20em;',
    //     'id' => 'menu_privilegios'
    //   ])
    //   ->accordion(args: ['label' => 'role', 'icon' => 'ph:tree-structure'])
    //   ->picklist(self: false, args: [
    //     'name' => "roles",
    //     'icon' => 'material-symbols:person-off-outline',
    //     'options' => '$roles',
    //     'allowItems' => '$allowRoles',
    //     'labelClass' => 'picklist-labelClass',
    //     'label' => false,
    //   ])
    //   ->ascend()
    //   ->accordion(args: ['label' => 'Usuarios permitidos', 'icon' => 'material-symbols:person-add-outline-rounded'])
    //   ->picklist(args: [
    //     'name' => "allowUsers",
    //     'options' => '$users',
    //     'allowItems' => '$allowUsers',
    //     'labelClass' => 'picklist-labelClass',
    //     'label' => 'Usuarios permitidos',
    //     'icon' => 'icon-park-outline:every-user'
    //   ])
    //   ->ascend(2)
    //   ->accordion(args: ['label' => 'Usuarios permitidos', 'icon' => 'material-symbols:person-add-outline-rounded'])
    //   ->picklist(args: [
    //     'name' => "allowUsers",
    //     'options' => '$users',
    //     'allowItems' => '$allowUsers',
    //     'labelClass' => 'picklist-labelClass',
    //     'label' => 'Usuarios permitidos',
    //     'icon' => 'icon-park-outline:every-user'
    //   ]);
    // $form = Input::form();
    $form->addChildren(

      Html::create(['class' => '$twoColumn'])
        ->addChildren(
          Html::create(['class' => ''])->children(
            [
              'icon',
              'nombre',
              'link',
              'posicion',
              'tipo',
              'status',
              'nota'
            ]
          )
        )
        ->addChildren(
          Html::create(['class' => ''])
            ->addChildren(

              Component::createFieldset([
                'legend' => 'Permisos',
                'toggleable' => true,
                'style' => 'float: left; min-width: 20em; max-width: 100%; overflow: scroll;',
                'id' => 'menu_privilegios'
              ])
                ->addChildren(
                  Component::createAccordion(['label' => 'role', 'icon' => 'ph:tree-structure'])
                    ->addChildren(
                      Picklist::create(
                        [
                          'name' => "roles",
                          'icon' => 'material-symbols:person-off-outline',
                          'options' => '$roles',
                          'allowItems' => '$allowRoles',
                          'labelClass' => 'picklist-labelClass',
                          'label' => false,
                        ]
                      )
                    )
                )->addChildren(
                  Component::createAccordion(['label' => 'Usuarios permitidos', 'icon' => 'material-symbols:person-add-outline-rounded'])
                    ->addChildren(
                      Picklist::create(
                        [
                          'name' => "allowUsers",
                          'options' => '$users',
                          'allowItems' => '$allowUsers',
                          'labelClass' => 'picklist-labelClass',
                          'label' => false,
                          'icon' => 'icon-park-outline:every-user'
                        ]
                      )
                    )
                )->addChildren(
                  Component::createAccordion(['label' => 'Usuarios no permitido', 'icon' => 'material-symbols:person-off-outline-rounded'])
                    ->addChildren(
                      Picklist::create(
                        [
                          'name' => "denyUsers",
                          'options' => '$users',
                          'allowItems' => '$denyUsers',
                          'labelClass' => 'picklist-labelClass',
                          'label' => false,
                        ]
                      )
                    )
                )
            )

        )

    );
    //         ->
    // ->html(attrs: ['class' => 'form-columns-2'])
    // ->html()
    // ->_children_(
    //   [
    //     'icon',
    //     'nombre',
    //     'link',
    //     'posicion',
    //     'tipo',
    //     'status',
    //     'nota'
    //   ]
    // )
    // ->ascend()
    // ->fieldset([
    //   'legend' => 'Permisos',
    //   'toggleable' => true,
    //   'style' => 'float: left; min-width: 20em;',
    //   'id' => 'menu_privilegios'
    // ])
    // ->accordion('Roles')->props('icon', 'ph:tree-structure')
    // ->pick([
    //   'name' => "roles",
    //   'icon' => 'material-symbols:person-off-outline',
    //   'options' => '$roles',
    //   'allowItems' => '$allowRoles',
    //   'labelClass' => 'picklist-labelClass',
    //   'label' => false,
    // ])
    // ->ascend()
    // ->accordion('Usuarios permitidos')->props('icon', 'icon-park-outline:every-user')
    // ->_picklist_([
    //   'name' => "allowUsers",
    //   'options' => '$users',
    //   'allowItems' => '$allowUsers',
    //   'labelClass' => 'picklist-labelClass',
    //   'label' => false,
    // ])
    // ->ascend()
    // ->accordion('Usuarios restringidos')
    // ->_picklist_([
    //   'name' => "denyUsers",
    //   'options' => '$users',
    //   'allowItems' => '$denyUsers',
    //   'labelClass' => 'picklist-labelClass',
    //   'label' => false,

    // ])
    // ->ascend()
    // ->accordion('Permisos')
    // ->_picklist_([
    //   'name' => "permisos",
    //   'options' => '$permisos',
    //   'allowItems' => '$allowPermisos',
    //   'labelClass' => 'picklist-labelClass',
    //   'label' => false,


    // ]);



    // $child = Input::create()->html('div', [
    //   'attrs' => [
    //     'class' => 'form-columns-2',
    //   ]
    //   ]); 



    $this->add($form);
    // $this->add($permiso_group);
    // $this->add($roles);

    return $this->getSchema();
  }
}
