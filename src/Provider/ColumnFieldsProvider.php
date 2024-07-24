<?php

declare(strict_types=1);

namespace App\Provider;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\ApiResource\Form\CreateForm;
use App\Attribute\ColumnTableList;
use function Symfony\Component\String\u;
use ReflectionClass;

class ColumnFieldsProvider implements ProviderInterface {

    public function __construct(private CreateForm $createForm) {
    }

    public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null {


        $className = u($uriVariables['className'])->camel()->title();

        // $className = "App\Entity\\{}";
        $reflectionClass = new ReflectionClass("App\Entity\\$className");
        if ($attrClass = $reflectionClass->getAttributes(ColumnTableList::class)) {
            return $attrClass[0]->newInstance()->columns;
        }

        return $reflectionClass->getProperties();
    }
}
