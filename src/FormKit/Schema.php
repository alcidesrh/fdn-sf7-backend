<?php

namespace App\FormKit;

use ApiPlatform\Metadata\IriConverterInterface;
use App\Attribute\FormMetadataAttribute;
use App\Entity\FormSchema;
use App\FormKit\Inputs\Accordion;
use App\FormKit\Inputs\Checkbox;
use App\FormKit\Inputs\Component;
use App\FormKit\Inputs\DateInput;
use App\FormKit\Inputs\Fieldset;
use App\FormKit\Inputs\Form;
use App\FormKit\Inputs\FormKitMessage;
use App\FormKit\Inputs\Group;
use App\FormKit\Inputs\Html;
use App\FormKit\Inputs\MultiSelect;
use App\FormKit\Inputs\Number;
use App\FormKit\Inputs\Password;
use App\FormKit\Inputs\Picklist;
use App\FormKit\Inputs\Select;
use App\FormKit\Inputs\Text;
use App\Repository\FormSchemaRepository;
use App\Services\Collection;
use App\Services\Reflection;
use DateTime;
use Doctrine\Common\Collections\Collection as CollectionsCollection;
use Doctrine\ORM\EntityManagerInterface;
use ReflectionClass;
use ReflectionProperty;
use Reflector;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;

class Schema {

  static int $contProperty = 0;
  private Filesystem $filesystem;
  private ?FormSchema $formSchema;
  protected ?ReflectionClass $reflection;
  protected  ?Collection $properties;

  private array $attrs = [];
  private array $defaultAttrs = ['exclude' => ['id', 'label', 'createdAt', 'updatedAt']];

  public string $entity = '' {
    set(string $entity) {
      $this->entity = "App\Entity\\" . $entity;
      $this->ini($entity);
    }
  }
  public string $schemaFileNameSpace {
    get {
      return 'App\FormKit\FormSchema\\' . $this->entityPathInfo['filename'] . 'Schema';
    }
  }
  public string $schemaFilePath {
    get {
      return __DIR__ . '/FormSchema/' . $this->entityPathInfo['filename'] . 'Schema.php';
    }
  }


  public function __construct(protected EntityManagerInterface $entityManager, protected IriConverterInterface $iriConverter, private FormSchemaRepository $formSchemaRepo, private  array $entityPathInfo) {
    $this->filesystem = new Filesystem();
    $this->entity = $this->entityPathInfo['filename'];
  }
  public function setReflection(): self {
    $this->reflection = new ReflectionClass($this->entity);
    $this->extractAttrs();

    $properties =
      (new Collection($this->reflection->getProperties()))->filter(
        fn(ReflectionProperty $reflectionProperty) => !\in_array($reflectionProperty->getName(), $this->attrs['exclude'] ?? [])
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
    $this->formSchema = $this->formSchemaRepo->findOneBy(['entity' => $this->entityPathInfo['filename']]);
    return $this;
  }
  public function ini(): self {
    $this->attrs = $this->defaultAttrs;
    $this->reflection = $this->properties = null;

    $this->setReflection()->setFormSchema();
    return $this;
  }
  public function getSchema(?string $entity = null): object|array {

    if ($entity && $this->entityPathInfo['filename'] != $entity) {
      $this->entity = $entity;
    }
    $this->checkAndBuild();

    return new class(
      $this->formSchema->getSchema()
    ) implements SchemaInterface {

      public function __construct(public array $schema) {
      }

      public function getSchema(): array {
        return [$this->schema];
      }
    };
  }

  public function checkAndBuild(): bool {
    if (
      !$this->formSchema ||
      Finder::create()->files()->in(__DIR__)->date('since ' . $this->formSchema->getUpdatedAt()->format('Y-m-d H:i:s'))->hasResults() ||
      Finder::create()->files()->in($this->entityPathInfo['dirname'])->files()->name($this->entityPathInfo['basename'])->date('since ' . $this->formSchema->getUpdatedAt()->format('Y-m-d H:i:s'))->hasResults()
    ) {
      if ($this->filesystem->exists($this->schemaFilePath)) {
        $group = ['div' => ['children' => (new ($this->schemaFileNameSpace))->entitySchema]];
        $form = $this->arrayToSchema($group);
      } else if (!empty($schema = $this->attrs['schema'] ?? [])) {
        $group = ['div' => ['children' => $schema]];
        $form = $this->arrayToSchema($group);
      } else {
        $group = ['div' => ['children' => $this->properties->map(fn($property) => $property->getName())->toArray()]];
        $form = $this->arrayToSchema(self::wraperSchemaArray($group['div']['children']));
      }
      if (isset($form)) {
        if (!$this->formSchema) {
          $this->formSchema = new FormSchema();
          $this->formSchema->setEntity($this->entityPathInfo['filename']);
        }
        $this->formSchema->setSchema($form());
        $this->formSchemaRepo->save($this->formSchema);

        return true;
      }
    }
    // }
    return false;
  }

  public function arrayToSchema(mixed $c) {

    foreach ($c as $k => $v) {
      $data = $v['props'] ?? $v;
      if (is_array($data)) {
        $data = \array_filter($data, fn($key) => $key !== 'children', ARRAY_FILTER_USE_KEY);
      }
      $input = match ($k) {
        'form' => Form::create($data),
        'div' =>   Html::create($data),
        'span' =>   Html::create($data),
        '$el' =>  Fieldset::create($data),
        'accordion' =>   Accordion::create($data),
        'picklist' =>   Picklist::create($data),
        'group' =>   Group::create($data),
        'FormKitMessages' => FormKitMessages::create($data),
        'component' => Component::createComponent($data),
        default => \is_string($k) ? $this->getInput($this->properties->getPropertyByName($k), $v) : $this->getInput($this->properties->getPropertyByName($v))
      };

      if ($input) {
        if (isset($v['merge'])) {
          $input->merge($v['merge']);
        }

        if (!empty($v['children'])) {

          if (is_numeric($v['children'])) {

            for ($i = self::$contProperty, $j = 0; $j < $v['children']; $i++, $j++) {

              $input->addChildren($this->getInput($this->properties->get($i)));
            }
          } else if (is_array($v['children'])) {

            foreach ($v['children'] as $key => $value) {

              if (is_string($value) && $child = $this->properties->getPropertyByName($value)) {

                $input->addChildren($this->getInput($child));
              } else {
                if (isset($value['name']) && $property = $this->properties->getPropertyByName($value['name'])) {

                  $input->addChildren($this->getInput($property, $value));
                } else if (\is_numeric($key)) {

                  if ($child = $this->arrayToSchema($value)) {
                    $input->addChildren($child);
                  }
                } else if ($child = $this->arrayToSchema([$key => $value])) {

                  $input->addChildren($child);
                }
              }
            }
          } else {
            $input->addChildren($v['children']);
          }
        }
      }
    }

    return $input;
  }
  public function getInput(ReflectionProperty $property, $props = []) {

    $field = $property->getName();

    if (!$typeInfo = Reflection::getType($this->entity, $field)) {
      return false;
    }

    if (isset($props['type'])) {
      $type = $props['type'];
      unset($props['type']);
    } else {
      $type = $property->getType()->getName();
    }
    if ($data = $property->getAttributes(FormMetadataAttribute::class)[0] ?? null) {
      $data = $data->newInstance()->data;
      if (isset($data['merge'])) {
        $toMerge = $data['merge'];
        $type = isset($toMerge['type']) ? $toMerge['type'] : $type;
      }
    }

    $input = self::input($type, $field);

    if (!$typeInfo->isNullable()) {
      $input->validation();
    }

    if (isset($toMerge)) {
      $input->merge($toMerge);
    }

    // if ($data = $property->getAttributes(FormMetadataAttribute::class)[0] ?? null) {
    //   $data = $data->newInstance()->data;
    //   if (isset($data['merge'])) {
    //     $input->merge($data['merge']);
    //   }
    // }

    if (!empty($props)) {
      $input->merge($props);
    }

    if (\in_array($input::class, [Select::class, MultiSelect::class])) {

      $class = ($typeInfo->getCollectionValueTypes()[0] ?? $typeInfo)->getClassName();

      if (\enum_exists($class)) {

        $input->set('options', \array_map(
          fn($enumItem) => ['label' => $enumItem->value, 'id' => $enumItem->value],
          $class::cases()
        ));
      } else {
        $input->remove('options');
        $input->set('target', basename(str_replace('\\', '/', $class)));
        //   $options = $class ? (new Collection($this->entityManager->getRepository($class)->findAll()))
        //     ->map(fn($el) => ['label' => (string)$el, 'value' => $this->iriConverter->getIriFromResource($el)])->toArray()
        //     : [];
        //   $input->set('options', $options);
        // }
      }
    }
    if ($input->containsKey('$el')) {
      $input->remove('$formkit');
    }
    self::$contProperty++;

    return $input;
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
  static public function input($type, $field) {
    return match ($type) {
      'string' => Text::create($field),
      'password' => Text::create(['name' => $field, 'type' => ' password']),
      'bool' => Checkbox::create($field),
      'int', 'float' => Number::create($field),
      'picklist' => Picklist::create($field),
      \DateTimeInterface::class, \DateTime::class => DateInput::create($field),
      CollectionsCollection::class, 'array' => MultiSelect::create($field),
      default => Select::create($field)
    };
  }
  static public function wraperSchemaArray(array $fields): array {

    $temp = ['div' => [
      'children' =>
      [
        [
          'div' =>
          [
            'class' => 'form-header',
            'children' => [
              [
                'span' =>
                [
                  'class' => 'font-medium u-text-1',
                  'children' => '$slots.header'
                ]
              ],
              [
                'div' => [
                  'children' => '$slots.crudBtn'
                ]
              ],
            ]
          ]
        ],
        [
          'div' => [
            'class' => 'toast-error-form',
            'children' => [
              'component' => 'FormKitMessages'
            ]
          ]
        ],
        [
          'div' => [
            'class' => 'row',
            'children' => [
              'div' => [
                'class' => 'col-6 col-md-3',
                'children' => []
              ]
            ]
          ]
        ]
      ]
    ]];
    $temp['div']['children'][2]['div']['children']['div']['children'] = $fields;

    return $temp;
  }
}
