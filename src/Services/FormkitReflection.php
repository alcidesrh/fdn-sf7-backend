<?php

namespace App\Services;

use ApiPlatform\Metadata\IriConverterInterface;
use App\Attribute\FormkitLabel;
use App\Attribute\FormkitSchema;
use App\FormKit\Inputs\MultiSelect;
use App\FormKit\Inputs\Number;
use App\FormKit\Inputs\Picklist;
use App\FormKit\Inputs\Select;
use App\FormKit\Inputs\Text;
use App\Services\ReflectionTrait;
use Doctrine\ORM\EntityManagerInterface;

class FormkitReflection extends Collection {

  use ReflectionTrait;

  protected ?EntityManagerInterface $entityManager;
  protected ?IriConverterInterface $iriConverter;
  private static array $exclude = [];

  public function __construct($className, ?EntityManagerInterface $entityManager, ?IriConverterInterface $iriConverter,) {

    // parent::__construct();

    $this->entityManager = $entityManager;
    $this->iriConverter = $iriConverter;
    $this->initReflectionTrait($className);
  }



  static public function reflectionField($field, $entity = false) {

    if ($entity) {
      self::setEntityPath($entity);
    }

    $info = Reflection::getExtractor();

    if (!$typeInfo = $info->getTypes(self::$entityPath, $field)[0] ?? null) {
      return false;
    }
    if ($collectionValueTypes = $typeInfo->getCollectionValueTypes()) {
      $class =  $collectionValueTypes[0]->getClassName();
    } else {
      $class = $typeInfo?->getClassName();
    }

    $property = self::$reflection->getProperty($field);

    if ($type = $property->getAttributes(FormkitSchema::class)[0] ?? null) {
      $type = $type->newInstance()->data;
    } else {
      $type = self::$reflection->getProperty($field)->getType()->getName();
    }

    $input = match ($type) {
      'string' => Text::create($field),
      'int' => Number::create($field),
      'picklist' => Picklist::create($field),
      // \in_array($class, [DateTimeInterface::class, DateTime::class]) => Input::create($field)->datepicker(),
      Collection::class, 'array' => MultiSelect::create($field),
      default => Select::create($field)
    };

    if ($labelAttrb = $property->getAttributes(FormkitLabel::class)[0] ?? null) {
      $input->set('label', $labelAttrb->newInstance()->label);
    }

    if (!$typeInfo->isNullable()) {
      $input->validation();
    }

    if (\in_array($input::class, ['Select', 'Multiselect'])) {

      if (\enum_exists($class)) {

        $input->set('options', \array_map(
          fn($enumItem) => ['label' => $enumItem->value, 'value' => $enumItem->value],
          $class::cases()
        ));
      } else {
        if ($selfRelation = $property->getAttributes(FormkitSchema::class)[0] ?? null) {
          $schema  = $selfRelation->newInstance()->data;
        } else {
          $options = (new Collection($this->entityManager->getRepository($class)->findAll()))
            ->map(fn($el) => ['label' => (string)$el, 'value' => $this->iriConverter->getIriFromResource($el)])->toArray();
          $input->set('options', $options);
        }
      }
    }

    return $input;
  }
}
