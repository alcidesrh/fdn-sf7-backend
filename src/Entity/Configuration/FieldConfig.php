<?php

namespace App\Entity\Configuration;

use App\Entity\Base\Traits\DataLoader;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\MappedSuperclass]
class FieldConfig {
  use DataLoader;
  #[ORM\Id]
  #[ORM\GeneratedValue]
  #[ORM\Column]
  protected ?int $id = null;

  #[ORM\ManyToOne(inversedBy: 'collectionFieldConfig')]
  protected EntityConfiguration $entityConfig;

  #[ORM\Column(length: 255)]
  protected string $field;

  #[ORM\Column(length: 255, nullable: true)]
  protected string $relatedTo;

  #[ORM\Column(length: 255, nullable: true)]
  protected ?string $type;

  #[ORM\Column(type: 'integer')]
  protected int $position;

  #[ORM\Column(nullable: true)]
  protected bool $visible = true;

  #[ORM\Column(length: 255, nullable: true)]
  protected ?string $label = null;

  #[ORM\Column(type: Types::JSON, nullable: true)]
  private ?array $attrs = null;

  public function getId(): ?int {
    return $this->id;
  }

  public function getEntityConfig(): EntityConfiguration {
    return $this->entityConfig;
  }

  public function setEntityConfig(EntityConfiguration $entityConfig): self {
    $this->entityConfig = $entityConfig;
    return $this;
  }

  public function getField(): string {
    return $this->field;
  }

  public function setField(string $field): self {
    $this->field = $field;
    return $this;
  }

  public function getRelatedTo(): string {
    return $this->relatedTo;
  }

  public function setRelatedTo(string $relatedTo): self {
    $this->relatedTo = $relatedTo;
    return $this;
  }

  public function getType(): string {
    return $this->type;
  }

  public function setType(string $type): self {
    $this->type = $type;
    return $this;
  }
  public function getName(): string {
    return $this->field;
  }
  public function getPosition(): int {
    return $this->position;
  }

  public function setPosition(int $position): self {
    $this->position = $position;
    return $this;
  }

  public function isVisible(): bool {
    return $this->visible;
  }

  public function setVisible(bool $visible): self {
    $this->visible = $visible;
    return $this;
  }
  public function getLabel(): ?string {
    return $this->label ?? $this->field;
  }

  public function setLabel(?string $label): self {
    $this->label = $label;
    return $this;
  }

  public function getAttrs(): ?array {
    return $this->attrs;
  }

  public function setAttrs(?array $attrs): self {
    $this->attrs = $attrs;
    return $this;
  }
}
