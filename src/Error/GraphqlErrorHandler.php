<?php

namespace App\Error;

use GraphQL\Error\ClientAware;

class GraphqlErrorHandler extends \Exception implements ClientAware {
  public function isClientSafe(): bool {
    return true;
  }
}
