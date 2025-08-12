<?php

namespace App\Error;

use ApiPlatform\GraphQl\Error\ErrorHandlerInterface;

final class ErrorHandler implements ErrorHandlerInterface {
  private $defaultErrorHandler;

  public function __construct(ErrorHandlerInterface $defaultErrorHandler) {
    $this->defaultErrorHandler = $defaultErrorHandler;
  }

  public function __invoke(array $errors, callable $formatter): array {
    // Log or filter the errors.

    return ($this->defaultErrorHandler)($errors, $formatter);
  }
}
