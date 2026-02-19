<?php
// api/src/Serializer/Exception/MyExceptionNormalizer.php
namespace App\Serializer\Normalizer;

use App\Entity\User;
use App\Exception\MyException;
use App\Services\ServerSentEvent;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use GraphQL\Error\Error;
use GraphQL\Error\FormattedError;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

final class GraphqlExceptionNormalizer implements NormalizerInterface {

  public function __construct(private ServerSentEvent $serverSentEvent) {
  }
  public function normalize($object, $format = null, array $context = []): array {
    $exception = $object->getPrevious();
    $error = FormattedError::createFromException($object);
    if ($exception instanceof UniqueConstraintViolationException) {
      $error['message'] = 'Datos duplicados';
      throw new \Exception('Something went wrong!');
    }

    // Add your logic here and add your specific data in the $error array (in the 'extensions' entry to follow the GraphQL specification).
    // $this->serverSentEvent->error(
    //   [
    //     'severity' => 'error',
    //     'detail' => "El usuario no existe",
    //     'summary' => 'No se pudo iniciar la sesión.'
    //   ]
    // );
    $error['extensions']['yourEntry'] = 'alcides';

    return []; //$error;
  }

  public function supportsNormalization($data, ?string $format = null, array $context = []): bool {
    return $data instanceof Error;
    // && $data->getPrevious() instanceof MyException;
  }

  public function getSupportedTypes(?string $format): array {
    return [
      'object' => false,
      '*' => false,
      User::class => true,
      Error::class => true
    ];
  }
}
