<?php

namespace App\Resolver;

use ApiPlatform\GraphQl\Resolver\QueryItemResolverInterface;
use App\Entity\Book;
use App\Repository\UserRepository;

final class UserByUsernameResolver implements QueryItemResolverInterface {

  public function __construct(private UserRepository $userRepository) {
  }
  /**
   * @param Book|null $item
   *
   * @return Book
   */
  public function __invoke($item, array $context): object {
    if ($arg = $context['args']['username'] ?? null) {
      return $this->userRepository->findOneBy(['username' => $arg]);
    }
    return $item;
  }
}
