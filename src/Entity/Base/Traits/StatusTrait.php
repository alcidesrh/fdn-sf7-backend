<?php

namespace App\Entity\Base\Traits;

use Doctrine\ORM\Mapping as ORM;
use App\Attribute\FormKitLabel;
use App\Enum\Status;
use App\Enum\StatusType;

trait StatusTrait {

    #[FormKitLabel('activo')]
    #[ORM\Column(type: StatusType::NAME, nullable: true)]
    protected ?Status $status = null;

    public function getStatus(): ?Status {
        return $this->status;
    }

    public function setStatus(Status $status): static {
        $this->status = $status;

        return $this;
    }
}
