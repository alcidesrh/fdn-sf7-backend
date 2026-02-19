<?php

namespace App\Error;

use ApiPlatform\GraphQl\Error\ErrorHandlerInterface;
use App\Services\ServerSentEvent;

final class ErrorHandler implements ErrorHandlerInterface {
  private $defaultErrorHandler;

  public function __construct(ErrorHandlerInterface $defaultErrorHandler, private ServerSentEvent $serverSentEvent) {
    $this->defaultErrorHandler = $defaultErrorHandler;
  }

  public function __invoke(array $errors, callable $formatter): array {
    // Log or filter the errors.
    // $this->serverSentEvent->error([
    //   'severity' => 'error',
    //   'detail' => "El usuario no existe",
    //   'summary' => 'No se pudo iniciar la sesión.'
    // ]);

    return ($this->defaultErrorHandler)($errors, $formatter);
  }
}
