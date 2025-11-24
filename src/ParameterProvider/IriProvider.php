<?php
// src/State/DynamicGroupProvider.php
namespace App\ParameterProvider;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\Metadata\Parameter;
use ApiPlatform\State\ParameterProviderInterface;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;

final class IriProvider implements ParameterProviderInterface {
  public function provide(Parameter $parameter, array $parameters = [], array $context = []): ?Operation {
    $operation = $context['operation'] ?? null;
    if (!$operation) {
      return null;
    }
    // $parameter->setValue('/api/users/1');
    // $value = $parameter->getValue();
    // if ('extended' === $value) {
    //   $context = $operation->getNormalizationContext();
    //   $context[AbstractNormalizer::GROUPS][] = 'extended_read';
    //   return $operation->withNormalizationContext($context);
    // }

    return $operation;
  }
}
