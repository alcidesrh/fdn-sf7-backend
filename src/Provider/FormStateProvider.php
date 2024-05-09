<?php

declare(strict_types=1);

namespace App\Provider;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\ApiResource\Form\CreateForm;

class FormStateProvider implements ProviderInterface {

    public function __construct(private CreateForm $createForm) {
    }

    public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null {


        // $return = new CreateForm($this->formKitGenerate);
        return $this->createForm->setClassName($uriVariables['className'])->getForm();
    }
}
