<?php

declare(strict_types=1);

namespace App\Provider;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\Attribute\AttributeUtil;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Routing\Route;

class ResourceAccessProvider implements ProviderInterface {

    public function __construct(private RouterInterface $router, #[Autowire('%kernel.project_dir%/src/Entity')] private $entityDir, private AttributeUtil $attributeUtil) {
    }

    public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null {

        $resource = $this->attributeUtil->getResources();

        $routes = $this->router->getRouteCollection()->getIterator();
        while ($routes->valid()) {
            $route = $routes->current();
            $routes->next();
        }
        $routes =
            array_map(
                fn ($i) => [array_values($i)],
                $this->router->getRouteCollection()->getIterator()->getArrayCopy()
            );
        // $return = new CreateForm($this->formKitGenerate);
        return [];
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
