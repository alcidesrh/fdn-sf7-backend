<?php

declare(strict_types=1);

namespace App\Provider;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\ApiResource\Form\CreateForm;
use App\Attribute\AttributeUtil;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Routing\Route;

class ResourceAccessProvider implements ProviderInterface {

    public function __construct(private CreateForm $createForm, private RouterInterface $router, #[Autowire('%kernel.project_dir%/src/Entity')] private $entityDir, private AttributeUtil $attributeUtil) {
    }

    public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null {


        $routes = $this->router->getRouteCollection()->getIterator();

        $routes =
            array_map(
                fn(Route $i) => $i->getPhemes(), //getDefault('name'),
                $this->router->getRouteCollection()->getIterator()->getArrayCopy()
            );

        return [[
            '$formkit' => 'select',
            'label' => 'Rutas',
            'name' => 'entity',
            'options' => $routes
        ]];
        return $routes;
        return $this->createForm->getForm($uriVariables['className']);
    }
}

//   {
//     $el: "div",
//     children: "Iniciar Sessión",
//     attrs: {
//       class: "u-text-l font-semibold text-zinc-600  mb-8 text-center",
//       style:
//         'font-variation-settings: "slnt" 0, "GRAD" -3, "XTRA" 400, "YOPQ" 106, "YTAS" 771, "YTDE" -268, "YTFI" 560, "YTLC" 514, "YTUC" 722; font-weight: 500; font-style: normal; font-stretch: 147.4 %;',
//     },
//   },
//   {
//     $formkit: "text",
//     name: "username",
//     label: "Usuario",
//     validation: "required",
//     labelClass: "u-text-m text-slate-700",
//   },
//   {
//     $formkit: "password",
//     name: "password",
//     label: "Contraseña",
//     validation: "required",
//     labelClass: "u-text-m text-slate-700",
//   },
//   {
//     $formkit: "submit",
//     name: "submit",
//     label: "Aceptar",
//     classes: {
//       wrapper: "flex justify-end mt-8",
//       input: "",
//     },
//   },
