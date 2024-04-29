<?php

namespace App\Entity\Base;

use App\Entity\Base\Interfaces\StatusInterface;
use App\Entity\Base\Traits\LegacyTrait;
use App\Entity\Base\Traits\StatusTrait;
use Doctrine\ORM\Mapping as ORM;

#[ORM\MappedSuperclass]
class TimeLegacyStatusBase extends Base implements StatusInterface {

  use TimestampableEntity, StatusTrait, LegacyTrait;
}
