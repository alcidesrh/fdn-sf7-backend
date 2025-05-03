<?php

namespace App\Services;

use ApiPlatform\Metadata\IriConverterInterface;
use App\Attribute\ExcludeAttribute;
use App\Attribute\FormkitDataReference;
use App\Attribute\FormkitLabel;
use App\Attribute\FormMetadataAttribute;
use App\Attribute\PropertyOrder;
use App\FormKit\Inputs\Checkbox;
use App\FormKit\Inputs\DateInput;
use App\FormKit\Inputs\MultiSelect;
use App\FormKit\Inputs\Number;
use App\FormKit\Inputs\Picklist;
use App\FormKit\Inputs\Select;
use App\FormKit\Inputs\Text;
use App\Services\Collection;
use DateTime;
use Doctrine\Common\Collections\Collection as CollectionsCollection;
use Doctrine\ORM\EntityManagerInterface;
use ReflectionClass;
use ReflectionProperty;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Symfony\Component\PropertyInfo\PropertyInfoExtractor;

trait ReflectionTrait {

  protected ReflectionClass $reflection;
  protected Collection $properties;
  // protected string $entity;
  protected EntityManagerInterface $entityManager;
  protected IriConverterInterface $iriConverter;
  private array $exclude = [];
  public string $entityName = "";
  public string $entity = '' {
    set(string $entity) {
      $this->entityName = $entity;
      $this->entity = "App\Entity\\" . $entity;
    }
  }


  // static public function entityPath($entity) {
  //   return "App\Entity\\" . $entity;
  // }

  public function reflectionField($field) {

    $info =  new PropertyInfoExtractor(typeExtractors: [new ReflectionExtractor()]);

    if (!$typeInfo = $info->getTypes($this->entity, $field)[0] ?? null) {
      return false;
    }

    $class = ($typeInfo->getCollectionValueTypes()[0] ?? $typeInfo)->getClassName();

    $property = $this->reflection->getProperty($field);

    if ($type = ($property->getAttributes(FormMetadataAttribute::class)[0] ?? null)) {
      $type = $type->newInstance()->data;
    } else {
      $type = $this->reflection->getProperty($field)->getType()->getName();
    }

    $input = match ($type) {
      'string' => Text::create($field),
      'bool' => Checkbox::create($field),
      'int', 'float' => Number::create($field),
      'picklist' => Picklist::create($field),
      \DateTimeInterface::class, \DateTime::class => DateInput::create($field),
      CollectionsCollection::class, 'array' => MultiSelect::create($field),
      default => Select::create($field)
    };

    if (!$typeInfo->isNullable()) {
      $input->validation();
    }

    if ($labelAttrb = $property->getAttributes(FormkitLabel::class)[0] ?? null) {
      $input->set('label', $labelAttrb->newInstance()->label);
    }

    if (\in_array($input::class, [Select::class, MultiSelect::class])) {

      if (\enum_exists($class)) {

        $input->set('options', \array_map(
          fn($enumItem) => ['label' => $enumItem->value, 'value' => $enumItem->value],
          $class::cases()
        ));
      } else {
        if ($reference = $property->getAttributes(FormkitDataReference::class)[0] ?? null) {
          $options = $reference->newInstance()->label;
        } else {
          $options = $class ? (new Collection($this->entityManager->getRepository($class)->findAll()))
            ->map(fn($el) => ['label' => (string)$el, 'value' => $this->iriConverter->getIriFromResource($el)])->toArray()
            : [];
        }
        $input->set('options', $options);
      }
    }
    return $input;
  }

  public function setProperties() {

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
