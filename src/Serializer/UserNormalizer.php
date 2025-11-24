<?php
// api/src/Serializer/PlainIdentifierDenormalizer

namespace App\Serializer;

use ApiPlatform\Metadata\IriConverterInterface;
use App\Entity\User;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectToPopulateTrait;
use Symfony\Component\Serializer\SerializerAwareTrait;

class UserNormalizer implements NormalizerInterface, NormalizerAwareInterface, DenormalizerInterface, DenormalizerAwareInterface {
    use DenormalizerAwareTrait;
    use SerializerAwareTrait;
    use ObjectToPopulateTrait;
    use NormalizerAwareTrait;


    private $iriConverter;

    public function __construct(IriConverterInterface $iriConverter) {
        $this->iriConverter = $iriConverter;
    }

    public function denormalize($data, $class, $format = null, array $context = []): mixed {


        // foreach ($data['roles'] as $key => $iri) {
        //     $data['roles'][$key] =  $this->iriConverter->getResourceFromIri($iri);
        // }
        unset($data['roles']);
        $return = $this->denormalizer->denormalize($data, $class, $format, $context + [__CLASS__ => true]);
        return $return;
    }

    public function normalize(mixed $object, ?string $format = null, array $context = []): array|string|int|float|bool|\ArrayObject|null {
        return $this->normalize($this->serializer, $format, $context);
    }

    public function supportsDenormalization($data, $type, $format = null, array $context = []): bool {
        return \in_array($format, ['graphql'], true) && is_a($type, User::class, true) && !empty($data) && !isset($context[__CLASS__]);
    }
    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool {
        return false;
        if (isset($context["resource_class"]) && $context["resource_class"] == User::class) {
            return true;
        }
        return false;
        return $data instanceof NormalizableInterface;
    }

    public function getSupportedTypes(?string $format): array {
        return [
            'object' => null,
            '*' => false,
            User::class => true
        ];
    }
}
