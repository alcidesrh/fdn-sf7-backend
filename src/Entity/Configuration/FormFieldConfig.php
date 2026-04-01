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
class FormFieldConfig extends FieldConfig {

  #[ORM\Column(length: 255, nullable: true)]
  private ?string $groupName = null;


  public function getGroupName(): ?string {
    return $this->groupName;
  }

  public function setGroupName(?string $groupName): self {
    $this->groupName = $groupName;
    return $this;
  }
}
