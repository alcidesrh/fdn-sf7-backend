<?php

namespace App\FormKit;

use ApiPlatform\Metadata\IriConverterInterface;
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
use App\Useful\Reflection;
use DateTime;
use Doctrine\Common\Collections\Collection as CollectionsCollection;
use Doctrine\ORM\EntityManagerInterface;
use ReflectionClass;
use ReflectionProperty;
use Reflector;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;

class Schema extends Collection {

  private Filesystem $filesystem;
  private ?FormSchema $formSchema;
  protected ?ReflectionClass $reflection;
  protected ?Collection $properties;

  private array $attrs = [];
  private array $defaultAttrs = ['exclude' => ['id', 'label', 'createdAt', 'updatedAt']];

  public string $entityName = "";
  public string $entity = '' {
    set(string $entity) {
      $this->entityName = $entity;
      $this->entity = "App\Entity\\" . $entity;
      $this->ini($entity);
    }
  }
  const FORM_SCHEMA_NAMESPACE = 'App\FormKit\FormSchema\\';

  public function __construct(protected EntityManagerInterface $entityManager, protected IriConverterInterface $iriConverter, private FormSchemaRepository $formSchemaRepo, string $entity) {

    $this->filesystem = new Filesystem();
    $this->entity = $entity;
  }
  public function setReflection(): self {
    $this->reflection = new ReflectionClass($this->entity);
    $this->extractAttrs();

    $properties =
      (new Collection($this->reflection->getProperties()))->filter(
        fn(ReflectionProperty $reflectionProperty) => $this->extractAttrs($reflectionProperty) && !\in_array($reflectionProperty->getName(), $this->attrs['exclude'] ?? [])
      );

    if (!empty($this->attrs['order'])) {
      $keys = $properties->map(fn($v) => $v->getName())->toArray();
      $keys = [...\array_intersect($this->attrs['order'], $keys), ...\array_diff($keys, $this->attrs['order'] ?? [])];
      $properties = new Collection(\array_map(fn($value) => $properties->findFirst(fn($k, $v) => $v->getName() == $value), $keys));
    }
    $this->properties = $properties;

    return $this;
  }
  public function setFormSchema(): self {
    $this->formSchema = $this->formSchemaRepo->findOneBy(['entity' => $this->entityName]);
    return $this;
  }
  public function ini(): self {
    $this->attrs = $this->defaultAttrs;
    $this->reflection = $this->properties = null;
    parent::clear();
    $this->setReflection()->setFormSchema();
    return $this;
  }
  public function getShema(?string $entity = null): object|array {

    if ($entity && $this->entityName != $entity) {
      $this->entity = $entity;
    }
    if ($this->hasChanged(__DIR__ . '/FormSchema/', $this->entityName . 'Schema.php')) {
      $this->build((new (self::FORM_SCHEMA_NAMESPACE . $this->entityName . 'Schema'))->entitySchema);
    } else if ($this->hasChanged(__DIR__ . '/../Entity/') || $this->hasChanged(__DIR__ . '/', 'Schema.php') || !$this->formSchema) {
      $this->build();
    }

    return $this->getShemaToObject();
  }
  public function build(array $entitySchema = []): self {
    if (!empty($entitySchema)) {
      if ($input = $this->arrayToSchema(new Collection($entitySchema))) {
        $this->add($input);
      }
    } else  if (
      $this->filesystem->exists(__DIR__ . '/FormSchema/' . $this->entityName . 'Schema.php') &&
      $input = $this->arrayToSchema(new Collection((new (self::FORM_SCHEMA_NAMESPACE . $this->entityName . 'Schema'))->entitySchema))
    ) {
      $this->add($input);
    } else {
      foreach ($this->properties as $value) {
        $this->add($this->getInput($value));
      }

      if (!empty($this->attrs['columns']) && $columns = $this->attrs['columns']) {
        if (\is_numeric($columns)) {
          $div = Html::create(['class' => "form-columns-{$columns}"]);
          foreach (\array_chunk($this->toArray(), \round($this->count() / $this->attrs['columns'])) as $v) {
            $temp = Html::create();
            $temp->children->value($v, $temp);
            $div->addChildren($temp);
          }
        } else if (\is_array($columns)) {
          $c = count($columns);
          $div = Html::create(['class' => "form-columns-$c"]);
          $cont = 0;

          foreach ($columns as $key => $value) {

            if (isset($value['wrapper'])) {
              if ($value['wrapper']['type'] == 'fieldset') {
                $wrap = Component::createFieldset($value['wrapper']['props'] ?? []);
              } else {
                $wrap = Html::create();
              }
            }
            $fields = isset($value['fields']) ? $value['fields'] + $cont : $this->properties->count();
            for ($i = $cont; $i < $fields; $i++, $cont++) {
              $wrap->addChildren($this->get($i));
            }
            $div->addChildren($wrap);
          }
        }

        $this->value($div);
      }
      $form = Form::create(['name' => $this->entityName . 'Form']);
      $form->children->value($this->toArray());
      $this->value($form);
    }
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
      $input = \in_array($v, $this->attrs['exclude'] ?? []) ?
        null :
        match ($k) {
          'form' => Form::create($v['props'] ?? []),
          'div' =>   Html::create($v['props'] ?? []),
          'fieldset' =>  Component::createFieldset($v['props'] ?? []),
          'accordion' =>   Component::createAccordion($v['props'] ?? []),
          'picklist' =>   Picklist::create($v['props'] ?? []),
          default => $this->getInput($this->properties->findFirst(fn($k, ReflectionProperty $item) => $item->getName() == $v))
        };

      if ($input && !empty($v['children'])) {

        foreach ($v['children'] as $value) {
          if ($child = $this->arrayToSchema(new Collection($value))) {
            $input->addChildren($child);
          }
        }
      }
    });
    return $input;
  }
  public function hasChanged($path, $name = null): bool {
    $name = $name ?: $this->entityName . '.php';

    if (!$this->filesystem->exists($path . $name) || !$this->formSchema) {
      return false;
    }
    $finder = new Finder();
    $finder->files()->in($path)->files()->name($name)->date('> ' . $this->formSchema->getUpdatedAt()->format('Y-m-d H:i'));
    if (\iterator_count($finder)) {
      return true;
    }
    return false;
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
  public function getInput(ReflectionProperty $property) {

    $field = $property->getName();

    if (!$typeInfo = Reflection::getType($this->entity, $field)) {
      return false;
    }

    $class = ($typeInfo->getCollectionValueTypes()[0] ?? $typeInfo)->getClassName();

    $type = $property->getType()->getName();

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

    if ($data = $property->getAttributes(FormMetadataAttribute::class)[0] ?? null) {
      $data = $data->newInstance()->data;
      if (isset($data['merge'])) {
        $input->merge($data['merge']);
      }
    }

    if (\in_array($input::class, [Select::class, MultiSelect::class])) {

      if (\enum_exists($class)) {

        $input->set('options', \array_map(
          fn($enumItem) => ['label' => $enumItem->value, 'value' => $enumItem->value],
          $class::cases()
        ));
      } else {
        if (!$input->exists(fn($k, $p) => $k == 'options')) {
          $options = $class ? (new Collection($this->entityManager->getRepository($class)->findAll()))
            ->map(fn($el) => ['label' => (string)$el, 'value' => $this->iriConverter->getIriFromResource($el)])->toArray()
            : [];
          $input->set('options', $options);
        }
      }
    }
    if ($input->findFirst(fn($k, $v) => $k == '$el')) {
      $input->remove('$formkit');
    }
    return $input;
  }
  public function setProperties() {
  }

  private function extractAttrs(?Reflector $reflector = null): self {
    $reflector = $reflector ?: $this->reflection;
    if ($data = $reflector->getAttributes(FormMetadataAttribute::class)) {
      foreach ($data[0]->newInstance()->data as $key => $value) {
        if (\is_array($value)) {
          $this->attrs[$key] = [...($this->attrs[$key] ?? []), ...$value];
        } else {
          $this->attrs[$key] = [...($this->attrs[$key] ?? []), $value];
        }
      }
    }
    return $this;
  }
}
