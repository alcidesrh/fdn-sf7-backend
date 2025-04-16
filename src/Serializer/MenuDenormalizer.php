<?php
// api/src/Serializer/PlainIdentifierDenormalizer

namespace App\Serializer;

use ApiPlatform\Api\IriConverterInterface;
use ApiPlatform\Metadata\IriConverterInterface as MetadataIriConverterInterface;
use App\ApiResource\Dummy;
use App\ApiResource\RelatedDummy;
use App\Entity\Menu;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;

class MenuDenormalizer implements DenormalizerInterface, DenormalizerAwareInterface {
  use DenormalizerAwareTrait;

  private $iriConverter;

  public function __construct(MetadataIriConverterInterface $iriConverter) {
    $this->iriConverter = $iriConverter;
  }

  public function denormalize($data, $class, $format = null, array $context = []): mixed {
    $data['relatedDummy'] = $this->iriConverter->getIriFromResource(resource: RelatedDummy::class, context: ['uri_variables' => ['id' => $data['relatedDummy']]]);

    return $this->denormalizer->denormalize($data, $class, $format, $context + [__CLASS__ => true]);
  }

  public function supportsDenormalization($data, $type, $format = null, array $context = []): bool {
    return \in_array($format, ['json', 'jsonld'], true) && is_a($type, Dummy::class, true) && !empty($data['relatedDummy']) && !isset($context[__CLASS__]);
  }

  public function getSupportedTypes(?string $format): array {
    return [
      'graphql' => true,
      'object' => null,
      '*' => false,
      Menu::class => true
    ];
  }
}
