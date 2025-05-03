<?php

namespace App\FormKit;

use ApiPlatform\Metadata\IriConverterInterface;
use App\Attribute\FormkitDataReference;
use App\Attribute\FormMetadataAttribute;
use App\Entity\FormSchema;
use App\FormKit\Inputs\Checkbox;
use App\FormKit\Inputs\Component;
use App\FormKit\Inputs\DateInput;
use App\FormKit\Inputs\Form;
use App\FormKit\Inputs\Html;
use App\FormKit\Inputs\Input;
use App\FormKit\Inputs\MultiSelect;
use App\FormKit\Inputs\Number;
use App\FormKit\Inputs\Picklist;
use App\FormKit\Inputs\Select;
use App\FormKit\Inputs\Text;
use App\Repository\FormSchemaRepository;
use App\Services\Collection;
use DateTime;
use Doctrine\Common\Collections\Collection as CollectionsCollection;
use Doctrine\ORM\EntityManagerInterface;
use ReflectionClass;
use ReflectionProperty;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Symfony\Component\PropertyInfo\PropertyInfoExtractor;

class Schema extends Collection {

  private ?FormSchema $formSchema;

  protected ReflectionClass $reflection;
  protected Collection $properties;
  private array $exclude = ['id', 'label'];

  public string $entityName = "";
  public string $entity = '' {
    set(string $entity) {
      $this->entityName = $entity;
      $this->entity = "App\Entity\\" . $entity;
    }
  }

  const FORM_SCHEMA_NAMESPACE = 'App\FormKit\FormSchema\\';


  public function __construct(protected EntityManagerInterface $entityManager, protected IriConverterInterface $iriConverter, private FormSchemaRepository $formSchemaRepo, $entity = "",) {

    $this->entity = $entity;
    $this->formSchema = $this->formSchemaRepo->findOneBy(['entity' => $this->entityName]);
  }

  public function build(array $entitySchema = []): self {

    $this->clear();
    $this->reflection = new ReflectionClass($this->entity);
    $this->setProperties();
    $form = Form::create(['name' => 'actionForm']);
    // $this->add($form);


    if (!empty($entitySchema)) {
      $this->add($this->arrayToSchema(new Collection($entitySchema)));
    } else {

      if ($data = $this->reflection->getAttributes(FormMetadataAttribute::class)) {
        $keys = $this->properties->map(fn($v) => $v->getName())->toArray();
        $data = $data[0]->newInstance()->data;
        if (!empty($data['order'])) {
          $keys = [...\array_intersect($data['order'], $keys), ...\array_diff($keys, $data['order'] ?? [])];
          $this->properties = new Collection(\array_map(fn($value) => $this->properties->findFirst(fn($k, $v) => $v->getName() == $value), $keys));
        }
      }
      foreach ($this->properties as $key => $value) {
        $this->add($this->reflectionField($value->getName()));
      }

      if (!empty($data['columns'])) {
        $div = Html::create(['class' => "form-columns-{$data['columns']}"]);
        foreach (\array_chunk($this->toArray(), \round($this->count() / $data['columns'])) as $v) {
          $temp = Html::create();
          $temp->children->value($v);
          $div->addChildren($temp);
        }
        $this->value($div);
      }
    }
    $form->children->value($this->toArray());
    $this->value($form);

    if (!$this->formSchema) {
      $this->formSchema = new FormSchema();
      $this->formSchema->setEntity($this->entityName);
    }
    $this->formSchema->setSchema($this->map(fn(Input $v) => $v())->toArray());
    $this->formSchemaRepo->save($this->formSchema);

    return $this;
  }

  public function arrayToSchema(Collection $c) {

    $input = null;
    $c->forAll(function ($k, $v) use (&$input) {

      $input = match ($k) {
        'form' => Form::create($v['props'] ?? []),
        'div' =>   Html::create($v['props'] ?? []),
        'fieldset' =>  Component::createFieldset($v['props'] ?? []),
        'accordion' =>   Component::createAccordion($v['props'] ?? []),
        'picklist' =>   Picklist::create($v['props'] ?? []),
        default => $this->reflectionField($v)
      };

      if (!empty($v['children'])) {

        foreach ($v['children'] as $value) {
          if ($child = $this->arrayToSchema(new Collection($value))) {
            $input->addChildren($child);
          }
        }
      }
    });

    return $input;
  }

  public function getShema(?string $entity = null): object|array {

    if ($entity && $this->entityName != $entity) {
      $this->entity = $entity;
      $this->formSchema = $this->formSchemaRepo->findOneBy(['entity' => $this->entityName]);
    }
    $filesystem = new Filesystem();
    $finder = new Finder();
    $name = $this->entityName . 'Schema';
    $path = __DIR__ . '/FormSchema/';

    if ($filesystem->exists($path . $name . '.php')) {
      if ($this->formSchema) {
        $finder->files()->in($path)->files()->name($name . '.php')->date('> ' . $this->formSchema->getUpdatedAt()->format('Y-m-d H:i'));
        if (\iterator_count($finder)) {
          $this->build((new (self::FORM_SCHEMA_NAMESPACE . $this->entityName . 'Schema'))->entitySchema);
        }
      } else {
        $this->build((new (self::FORM_SCHEMA_NAMESPACE . $this->entityName . 'Schema'))->entitySchema);
      }
    } else {

      if ($this->formSchema) {
        $path = __DIR__ . '/../Entity/';
        $finder->files()->in($path)->files()->name($this->entityName . '.php')->date('> ' . $this->formSchema->getUpdatedAt()->format('Y-m-d H:i'));
        if (\iterator_count($finder)) {
          $this->build();
        }
      } else {
        $this->build();
      }
    }
    return $this->getShemaToObject();
  }

  public function getShemaToObject(): object {

    return new class(
      $this->formSchema->getSchema()
    ) implements SchemaInterface {

      public function __construct(public array $schema) {
      }

      public function getSchema(): array {
        return $this->schema;
      }
    };
  }

  public function reflectionField($field) {

    $info =  new PropertyInfoExtractor(typeExtractors: [new ReflectionExtractor()]);

    if (!$typeInfo = $info->getTypes($this->entity, $field)[0] ?? null) {
      return false;
    }

    $class = ($typeInfo->getCollectionValueTypes()[0] ?? $typeInfo)->getClassName();

    $property = $this->reflection->getProperty($field);

    $type = $this->reflection->getProperty($field)->getType()->getName();

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

    $exclude = [];
    if ($attrsExclude = $this->reflection->getAttributes(ExcludeAttribute::class)) {
      $exclude = $attrsExclude[0]->newInstance()->fields;
    }

    foreach ($this->reflection->getProperties() as $value) {
      if ($value->getAttributes(ExcludeAttribute::class)) {
        $exclude[] = $value->getName();
      }
    }
    $this->exclude = [...$this->exclude, ...$exclude];

    $this->properties = $this->properties->filter(fn(ReflectionProperty $reflectionProperty) => !in_array($reflectionProperty->getName(), $this->exclude));
  }
}
