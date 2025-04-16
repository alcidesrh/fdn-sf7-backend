<?php

namespace App\Resolver;

use ApiPlatform\GraphQl\Resolver\QueryItemResolverInterface;
use App\Entity\User;
use App\Repository\UserRepository;
use App\Services\ServerSentEvent;


final class UserByUsernameResolver implements QueryItemResolverInterface {

  public function __construct(private UserRepository $userRepository, private ServerSentEvent $serverSentEvent) {
  }
  /**
   */
  public function __invoke($item, array $context): object {
    if ($arg = $context['args']['username'] ?? null) {
      if ($user = $this->userRepository->findOneBy(['username' => $arg]))
        return $user;
    }
    $this->serverSentEvent->error([
      'severity' => 'error',
      'msg' => "El usuario <b>{$arg}<b/> no existe",
      'summary' => 'Usuario'
    ]);

    return new User();
  }
}
