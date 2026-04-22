<?php

namespace App\Entity\Configuration;

use ApiPlatform\Doctrine\Orm\Filter\ExactFilter;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\GraphQl\QueryCollection;
use ApiPlatform\Metadata\GraphQl\Mutation;
use ApiPlatform\Metadata\GraphQl\Query;
use ApiPlatform\Metadata\QueryParameter;
use App\Attribute\ApiResourceNoPagination;
use App\DTO\EntityConfigurationDTO;
use App\GraphQL\Type\Definition\EntityConfigurationType;
use App\Repository\EntityConfigurationRepository;
use App\Resolver\EntityConfigurationResolver;
use App\Resolver\UpdateEntityConfigurationFieldsResolver;

#[ORM\Entity(repositoryClass: EntityConfigurationRepository::class)]
#[ApiResourceNoPagination(
  graphQlOperations: [
    new Query(name: 'item_query'),
    new Query(
      name: 'entityConfigurationByClass',
      parameters: [
        'entityClass' => new QueryParameter(
          filter: new ExactFilter(),
          property: 'entityClass'
        ),
      ],
      output: EntityConfigurationDTO::class
    ),
    new QueryCollection(
      paginationEnabled: false,
      parameters: [
        'entityClass' => new QueryParameter(
          filter: new ExactFilter(),
          property: 'entityClass'
        ),
      ],
      output: EntityConfigurationDTO::class
    ),

    // new Mutation(name: 'update', security: 'is_granted("ROLE_ADMIN_CONFIG")'),
    new Mutation(name: 'update'),
    new Mutation(
      name: 'updateWithRelations',
      resolver: UpdateEntityConfigurationFieldsResolver::class,
      read: true,          // Carga automáticamente la entidad
      deserialize: false,  // Evita la deserialización automática
      validate: false,
      args: [
        'entityClass' => [
          'type' => 'String!',
          'description' => 'IRI o ID de la entidad (ej: "/api/entity_configurations/97")'
        ],
        'formFields' => [
          'type' => '[updateFormFieldConfigInput]',   // JSON como string
        ],
        'collectionFieldConfig' => [
          'type' => '[updateCollectionFieldConfigInput]',
        ]
      ]
    )
  ],
  // normalizationContext: ['groups' => ['entity_config:read']],
  // denormalizationContext: ['groups' => ['entity_config:write']],
)]
class EntityConfiguration {
  #[ORM\Id]
  #[ORM\GeneratedValue]
  #[ORM\Column]
  // #[Groups(['entity_config:read'])]
  private ?int $id = null;

  #[ORM\Column(length: 255, unique: true)]
  // #[Groups(['entity_config:read', 'entity_config:write'])]
  private string $entityClass;

  #[ORM\OneToMany(mappedBy: 'entityConfig', targetEntity: CollectionFieldConfig::class, cascade: ['persist', 'remove'], orphanRemoval: true, fetch: 'LAZY')]
  private Collection $collectionFieldConfig;

  #[ORM\OneToMany(mappedBy: 'entityConfig', targetEntity: FormFieldConfig::class, cascade: ['persist', 'remove'], orphanRemoval: true)]
  private Collection $formFields;


  public function __construct(string $entityClass) {
    $this->entityClass = $entityClass;
    $this->collectionFieldConfig = new ArrayCollection();
    $this->formFields = new ArrayCollection();
  }

  public function getId(): ?int {
    return $this->id;
  }

  public function setEntityClass($entityClass): self {
    $this->entityClass = $entityClass;
    return $this;
  }

  public function getEntityClass(): string {
    return $this->entityClass;
  }

  /**
   * @return Collection<int, CollectionFieldConfig>
   */
  public function getCollectionFieldConfig(): Collection {
    return $this->collectionFieldConfig;
  }

  public function addCollectionFieldConfig(CollectionFieldConfig $collectionFieldConfig): self {
    if (!$this->collectionFieldConfig->contains($collectionFieldConfig)) {
      $this->collectionFieldConfig->add($collectionFieldConfig);
      $collectionFieldConfig->setEntityConfig($this);
    }
    return $this;
  }

  public function removeCollectionFieldConfig(CollectionFieldConfig $collectionFieldConfig): self {
    if ($this->collectionFieldConfig->removeElement($collectionFieldConfig)) {
      if ($collectionFieldConfig->getEntityConfig() === $this) {
        $collectionFieldConfig->setEntityConfig(null);
      }
    }
    return $this;
  }

  /**
   * @return Collection<int, FormFieldConfig>
   */
  public function getFormFields(): Collection {
    return $this->formFields;
  }

  public function addFormField(FormFieldConfig $formField): self {
    if (!$this->formFields->contains($formField)) {
      $this->formFields->add($formField);
      $formField->setEntityConfig($this);
    }
    return $this;
  }

  public function removeFormField(FormFieldConfig $formField): self {
    if ($this->formFields->removeElement('$formField')) {
      if ($formField->getEntityConfig() === $this) {
        $formField->setEntityConfig(null);
      }
    }
    return $this;
  }
}
