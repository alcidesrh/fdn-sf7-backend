<?php

namespace App\DTO;

use App\Enum\Status;

final class MetadataDTO extends DTOBase {


  public function __construct(public array|null $status = null, public array|null $columns = null) {
    $this->id = new \DateTime();
  }

  public function getStatus(): array|null {
    return Status::cases(); // $this->status;
  }


  public function getColumns(): array|null {
    return $this->columns;
  }
}
