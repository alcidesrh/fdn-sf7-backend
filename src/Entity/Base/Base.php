<?php

namespace App\Entity\Base;

use App\Attribute\AttributeUtil;
use App\Attribute\FormKitExclude;
use Doctrine\ORM\Mapping as ORM;
use ReflectionClass;

#[ORM\MappedSuperclass]
class Base {


    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[FormKitExclude]
    protected ?int $id = null;

    protected ?string $label = null;

    public function getId(): ?int {
        return $this->id;
    }
    public function getLabel() {

        $class = get_class($this);
        $info = AttributeUtil::getExtractor();
        $properties = $info->getProperties($class);
        if (!empty(\array_intersect($properties, ['nombre', 'name']))) {
            try {
                return $this->getNombre();
            } catch (\Throwable $th) {
                try {
                    return $this->getName();
                } catch (\Throwable $th) {
                    throw $th;
                }
            }
        }
        return $this->getId();
    }
    public function __toString() {

        return $this->getLabel();
    }
}
