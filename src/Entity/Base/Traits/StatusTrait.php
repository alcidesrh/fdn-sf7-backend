<?php

namespace App\Entity\Base\Traits;

use Doctrine\ORM\Mapping as ORM;
use App\Enum\Status;

trait StatusTrait {


    #[ORM\Column(type: "string", enumType: Status::class, nullable: true)]
    protected ?Status $status = null;

    public function getStatus(): ?Status {
        return $this->status;
    }

    public function setStatus(Status $status): static {
        $this->status = $status;

        return $this;
    }
}
