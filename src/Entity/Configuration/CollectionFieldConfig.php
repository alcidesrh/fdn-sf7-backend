<?php

namespace App\Entity\Configuration;

use ApiPlatform\Metadata\GraphQl\QueryCollection;
use App\Attribute\ApiResourceNoPagination;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ApiResourceNoPagination(
  graphQlOperations: [
    new QueryCollection(
      paginationEnabled: false,
      order: ['position' => 'ASC'],
    ),
  ]
)]
class CollectionFieldConfig extends FieldConfig {

  #[ORM\Column(nullable: true)]
  private bool $sortable = false;

  #[ORM\Column(nullable: true)]
  private bool $filterable = false;

  public function isSortable(): bool {
    return $this->sortable;
  }

  public function setSortable(bool $sortable): self {
    $this->sortable = $sortable;
    return $this;
  }

  public function isFilterable(): bool {
    return $this->filterable;
  }

  public function setFilterable(bool $filterable): self {
    $this->filterable = $filterable;
    return $this;
  }
}
