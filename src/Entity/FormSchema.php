<?php

namespace App\Entity;

use App\Repository\FormSchemaRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

#[ORM\Entity(repositoryClass: FormSchemaRepository::class)]
class FormSchema {
    use TimestampableEntity;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $entity = null;

    #[ORM\Column]
    private array $schema = [];

    public function getId(): ?int {
        return $this->id;
    }

    public function getEntity(): ?string {
        return $this->entity;
    }

    public function setEntity(string $entity): static {
        $this->entity = $entity;

        return $this;
    }

    public function getSchema(): array {
        return $this->schema;
    }

    public function setSchema(array $schema): static {
        $this->schema = $schema;

        return $this;
    }
}
