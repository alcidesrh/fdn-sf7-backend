<?php

namespace App\Services;

use App\Entity\Configuration\CollectionFieldConfig;
use App\Entity\Configuration\EntityConfiguration;
use App\Entity\Configuration\collectionFieldConfigConfig;
use App\Entity\Configuration\FormFieldConfig;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\ClassMetadata;
use Psr\Log\LoggerInterface;

final class EntityConfigSynchronizer {
  public function __construct(
    private readonly EntityManagerInterface $entityManager,
    private readonly LoggerInterface $logger
  ) {
  }

  public function syncEntity(string $entityClass): void {
    $config = $this->entityManager->getRepository(EntityConfiguration::class)
      ->findOneBy(['entityClass' => $entityClass]);

    if (!$config) {
      $config = new EntityConfiguration($entityClass);
      $this->entityManager->persist($config);
      $this->logger->info('Configuración inicial creada para {entity}', ['entity' => $entityClass]);
    }

    $metadata = $this->entityManager->getClassMetadata('App\\Entity\\' . $entityClass);
    $currentFields = $this->getAllFieldNames($metadata);

    $this->syncCollectionFieldConfig($config, $currentFields);
    $this->syncFormFields($config, $currentFields);

    $this->entityManager->flush();
    $this->logger->debug('Sincronización completada para {entity}', ['entity' => $entityClass]);
  }

  public function getAllFieldNames(ClassMetadata $metadata): array {

    // Campos simples (columnas en la tabla user)
    $camposSimples = $metadata->getFieldNames();
    // Ejemplo típico: ['id', 'email', 'username', 'createdAt', 'isActive']

    // Relaciones (propiedades que son entidades o colecciones)
    $relaciones = $metadata->getAssociationNames();
    // Ejemplo típico: ['profile', 'roles', 'posts', 'address', 'favoriteProducts']

    // Combinado: todos los "atributos mapeados"
    $todosLosNombres = array_merge($camposSimples, $relaciones);

    // Para mayor detalle puedes hacer:
    $detalle = [];
    foreach ($camposSimples as $campo) {
      $detalle[] = [$campo, match ($metadata->getFieldMapping($campo)['type']) {
        'string', 'text'  => 'text',
        'integer', 'float' => 'number',
        default => $metadata->getFieldMapping($campo)['type'],
      }];
    }

    foreach ($relaciones as $relacion) {
      $temp = $metadata->getAssociationTargetClass($relacion);
      $detalle[] = [
        $relacion,
        match ($metadata->getAssociationMapping($relacion)['type']) {
          \Doctrine\ORM\Mapping\ClassMetadata::ONE_TO_ONE   => 'select', //'OneToOne',
          \Doctrine\ORM\Mapping\ClassMetadata::MANY_TO_ONE  => 'select', //'ManyToOne',
          \Doctrine\ORM\Mapping\ClassMetadata::ONE_TO_MANY  => 'multiple', //OneToMany',
          \Doctrine\ORM\Mapping\ClassMetadata::MANY_TO_MANY => 'multiple', //'ManyToMany',
          default => 'Desconocido',
        },
        substr($temp, strrpos($temp, '\\') + 1)
      ];
    }
    return $detalle;
  }


  private function syncCollectionFieldConfig(EntityConfiguration $config, array $currentFields): void {
    $existing = [];
    foreach ($config->getCollectionFieldConfig() as $field) {
      $existing[$field->getField()] = $field;
    }

    $maxPosition = 0; // $existing ? max(array_map(fn($f) => $f->getPosition(), $existing)) : 0;

    foreach ($currentFields as $data) {
      if (!isset($existing[$data[0]])) {
        $collectionFieldConfig = new CollectionFieldConfig();
        $this->entityManager->persist($collectionFieldConfig);
        $collectionFieldConfig->setPosition(++$maxPosition);
      } else {
        $collectionFieldConfig = $existing[$data[0]];
        $collectionFieldConfig->setPosition(++$maxPosition);
      }

      $collectionFieldConfig->setField($data[0]);
      $collectionFieldConfig->setVisible(true);
      $collectionFieldConfig->setSortable(false);
      $collectionFieldConfig->setLabel(null);
      $collectionFieldConfig->setAttrs(null);


      $config->addcollectionFieldConfig($collectionFieldConfig);

      $this->logger->info('Campo de listado añadido automáticamente: {field} en {entity}', [
        'field' => $data[0],
        'entity' => $config->getEntityClass()
      ]);
    }
  }

  private function syncFormFields(EntityConfiguration $config, array $currentFields): void {
    $existing = [];
    foreach ($config->getFormFields() as $field) {
      $existing[$field->getField()] = $field;
    }

    $maxPosition = 0; //$existing ? max(array_map(fn($f) => $f->getPosition(), $existing)) : 0;

    foreach ($currentFields as $data) {
      if (!isset($existing[$data[0]])) {
        $formField = new FormFieldConfig();
        $this->entityManager->persist($formField);
        $formField->setPosition(++$maxPosition);
      } else {
        $formField = $existing[$data[0]];
      }
      $formField->setField($data[0]);
      $formField->setType($data[1]);
      $formField->setGroupName(null);
      $formField->setAttrs(null);
      $formField->setVisible(true);
      $formField->setLabel(true);
      if (count($data) > 2) {
        $formField->setRelatedTo($data[2]);
      }

      $config->addFormField($formField);

      $this->logger->info('Campo de formulario añadido automáticamente: {field} en {entity}', [
        'field' => $data[0],
        'entity' => $config->getEntityClass()
      ]);
    }
  }
}
