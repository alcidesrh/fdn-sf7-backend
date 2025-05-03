<?php

namespace App\Services;

use ApiPlatform\Metadata\IriConverterInterface;
use App\Attribute\FormkitLabel;
use App\Attribute\FormMetadataAttribute;
use App\FormKit\Inputs\MultiSelect;
use App\FormKit\Inputs\Number;
use App\FormKit\Inputs\Picklist;
use App\FormKit\Inputs\Select;
use App\FormKit\Inputs\Text;
use Doctrine\ORM\EntityManagerInterface;
use ReflectionClass;

class FormkitReflection extends Collection {

  private ReflectionClass $reflection;
  private string $entityPath;

  private static array $exclude = [];

  public function __construct(private EntityManagerInterface $entityManager, private IriConverterInterface $iriConverter, private Collection $properties) {

    parent::__construct();

    $this->entityManager = $entityManager;
    $this->iriConverter = $iriConverter;
    $this->properties = new Collection();
  }





  public function reflectionField($field, $entity = false) {

    if ($entity) {
      self::setEntityPath($entity);
    }

    $info = Reflection::getExtractor();

    if (!$typeInfo = $info->getTypes($this->entityPath, $field)[0] ?? null) {
      return false;
    }
    if ($collectionValueTypes = $typeInfo->getCollectionValueTypes()) {
      $class =  $collectionValueTypes[0]->getClassName();
    } else {
      $class = $typeInfo?->getClassName();
    }

    $property = $this->reflection->getProperty($field);

    if ($type = $property->getAttributes(FormMetadataAttribute::class)[0] ?? null) {
      $type = $type->newInstance()->data;
    } else {
      $type = $this->reflection->getProperty($field)->getType()->getName();
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
    if (\in_array($input::class, [Select::class, MultiSelect::class])) {

      if (\enum_exists($class)) {

        $input->set('options', \array_map(
          fn($enumItem) => ['label' => $enumItem->value, 'value' => $enumItem->value],
          $class::cases()
        ));
      } else {
        if ($selfRelation = $property->getAttributes(FormMetadataAttribute::class)[0] ?? null) {
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

  private function setProperties() {

    $this->properties = new Collection($this->reflection->getProperties());

    if ($attrsExclude = $this->reflection->getAttributes(ExcludeAttribute::class)) {
      $exclude = \array_merge($this->exclude, $attrsExclude[0]->newInstance()->fields);
    }

    foreach ($this->reflection->getProperties() as $value) {
      if ($value->getAttributes(ExcludeAttribute::class)) {
        $exclude[] = $value->getName();
      }
    }

    if (!empty($exclude)) {

      $this->properties = $this->properties->filter(fn(ReflectionProperty $reflectionProperty) => !in_array($reflectionProperty->getName(), $this->exclude));
    }

    if ($order = $this->reflection->getAttributes(PropertyOrder::class)) {
      $keys = $this->properties->getKeys();
      $order = $order[0]->newInstance()->fields;
      $keys = [...\array_intersect($order, $keys), ...\array_diff($keys, $order ?? [])];
      $this->properties = new Collection(\array_map(fn($key) => $this->properties->get($key), $keys));
    }
  }
}
