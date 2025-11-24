<?php

namespace App\Resolver;

use ApiPlatform\GraphQl\Resolver\QueryItemResolverInterface;
use App\Repository\MenuRepository;


final class MenuResolver implements QueryItemResolverInterface {

  public function __construct(private MenuRepository $repo) {
  }
  /**
   */
  public function __invoke($item, array $context): object {
    if ($arg = $context['args']['tipo'] ?? null) {
      if ($item = $this->repo->findOneBy(['tipo' => $arg]))
        return $item;
    }

    return new User();
  }
}
