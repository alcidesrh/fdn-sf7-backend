<?php

namespace App\FormKit;

use App\FormKit\Inputs\Input as InputsInput;
use App\Services\Collection;
use App\Services\FormkitReflection;
use function Symfony\Component\String\u;

final class Input extends Collection {

  public static $inputBase = ['name' => '', 'label' => '', 'validation' => false];

  public Collection $children;

  public self $parent;

  public string $type;

  public bool $addingChild = false;

  public function __construct(array|string $arg = [], array|null $base = null, $empty = false) {
    $this->children = new Collection();
    parent::__construct([...($empty ? [] : $base ?? self::base())]);
    $this->props($arg);
  }
  public static function base(...$arg): array {
    return [
      ...self::$inputBase,
      ...$arg
    ];
  }
  public static function create(array|string $args = []): self {
    return new self($args);
  }

  static public function elStatic($type, $arg): self {
    $input = new self(['$el' => $type], ['attrs' => []]);
    $input->props(['attrs' => $arg]);
    return $input;
  }

  static public function groupStatic($arg = []): self {

    return (new self(['$formkit' => 'group'], empty: true))->props($arg);
  }

  static public function form($arg = []): self {
    return (new self(['$formkit' => 'form', 'actions' => false, 'modelValue' => '$item'], empty: true))->props($arg);
  }

  public function parentOf(): self {
    $this->addingChild = false;
    return $this;
  }
  public function childs(): self {
    $this->addingChild = true;
    return $this;
  }


  public function __call($name, array $input) {

    if ($name == 'return') {
      if ($this->addingChild) {
        $this->addChildren($input[0]);
        return $this;
      }
      return $input[0];
    }
  }
  public function common(Input $input, $arg = []) {
    if (!empty($arg)) {
      if (!$input->containsKey('$el')) {
        $input->props($arg);
      } else {

        $input->props(['attrs' => $arg]);
      }
    }
    $input->parent = $this;
    $this->addChildren($input);
    return $this->return($input);
  }

  public function html($attrs = [], $el = 'div'): self {
    $input = new self(['$el' => $el], empty: true);
    return $this->common($input, $attrs);
  }

  public function group($arg = []): self {
    $input = (new self(['$formkit' => 'group'], empty: true));
    return $this->common($input, $arg);
  }

  public function fieldset(array|string $arg = []): self {
    $props = [
      'props' => [
        'value' => '$value',
        'context' => '$node.context',
        'attrs' => ['toggleable' => true, ...$arg]
      ],
    ];

    $input = (new self(['$cmp' => 'FieldsetFdn', 'children' => [],], empty: true));
    return $this->common($input, $props);
  }

  public function accordion(array|string $arg = []): self {

    $input = (new self(['$cmp' => 'AccordionFdn', 'children' => []], empty: true));
    $props = [
      'props' => [
        'value' => '$value',
        'context' => '$node.context',
        'attrs' => [
          'style' => 'margin-bottom: 20px'
        ],
        ...[...(is_string($arg) ? ['name' => u($arg)->snake()] : ['name' => 'accordion_fdn', ...$arg])]
      ],
    ];
    if (is_string($arg)) {
      $props['props']['label'] = $arg;
      $methodMagic = u($arg)->snake();
    }

    return $this->common($input, $props);
  }

  public function ascend($up = 1): self {
    $input = $this;
    for ($i = 0; $i < $up; $i++, $input = $input->parent);
    return $input;
  }


  public function name($name): self {
    $this->set('name', $name);
    return $this;
  }

  public function label($name): self {
    $this->set('label', $name);
    return $this;
  }


  public function text(array|string $arg = []): self {
    $this->set('$formkit', 'text_fdn')->props($arg)->type = 'text';

    return $this;
  }
  /**
   * {@inheritDoc}
   */
  public function set(string|int $key, mixed $value): self {
    parent::set($key, $value);
    return $this;
  }

  public function select(array|string $arg = []): self {
    $this->set('$formkit', 'select_fdn')->props($arg)->type = 'select';;
    return $this;
  }

  public function _picklist_(array|string $arg = []): self {

    $arg = is_string($arg) ? ['name' => $arg] : $arg;
    $input = self::create()->set('$formkit', 'picklist_fdn')->props(['outerClass' => 'picklist-outerClass', ...$arg]);
    $input->parent = $this;
    $input->type = 'picklist';
    return $this->_children_($input);
  }

  public function _children_(mixed $data): self {

    if (!is_array($data)) {
      $data = [$data];
    }
    foreach ($data as $value) {
      if (\is_a($value, Input::class)) {
        $this->addChildren($value);
      } else if (is_string($value)) {
        $this->addChildren(FormkitReflection::reflectionField($value));
      } else if (is_array($value)) {
        $this->_children_($value);
      }
    }



    return $this;
  }

  public function number(array|string $arg = []): self {
    $this->set('$formkit', 'number_fdn')->props($arg)->type = 'number';;
    return $this;
  }
  public function checkbox(array|string $arg = []): self {
    $this->set('$formkit', 'checkbox_fdn')->props($arg)->type = 'checkbox';
    return $this;
  }
  public function multiselect(array|string $arg = []): self {
    $this->set('$formkit', 'multiselect_fdn')->props($arg)->type = 'multiselect';
    return $this;
  }
  public function radio(array|string $arg = []): self {
    $this->set('$formkit', 'radio_fdn')->props($arg)->type = 'radio';
    return $this;
  }
  public function textarea(array|string $arg = []): self {
    $this->set('$formkit', 'textarea_fdn')->props($arg)->type = 'texttarea';
    return $this;
  }
  public function texticon(array|string $arg = []): self {
    $this->set('$formkit', 'texticon_fdn')->props($arg)->type = 'texticon';;
    return $this;
  }
  public function switch(array|string $arg = []): self {
    $this->set('$formkit', 'toggleswitch_fdn')->props($arg)->type = 'switch';
    return $this;
  }
  public function autocomplete(array|string $arg = []): self {
    $this->set('$formkit', 'autocomplete_fdn')->props($arg)->type = 'autocmplete';
    return $this;
  }



  public function datepicker(array|string $arg = []): self {
    $this->set('$formkit', 'datepicker_fdn')->props($arg)->type = 'datepicker';
    return $this;
  }

  public function validation($validation = 'required'): self {
    $this->set('validation', $validation);
    return $this;
  }


  public function props(array|string $args = [], ...$params): self {

    $props = $this->get('props');
    $self = $this;
    $save = function ($k, $v) use ($self, $props) {
      if (!empty($props)) {
        $props[$k] = $v;
        $self->set('props', $props);
      } else {
        $self->set($k, $v);
      }
    };

    if (is_array($args)) {
      foreach ($args as $key => $value) {
        // $this->set($key, $value);
        $save($key, $value);
      }
    } else if (\is_string($args)) {

      if ($temp = ($params[0] ?? false)) {
        // $this->set($args, $temp[0]);
        $save($args, $temp);
      } else {
        $save('name', $args);

        // $this->set('name', $args);
      }
    }
    if ($name = $this->get('name')) {
      foreach (['id', 'label'] as $key) {
        if ($this->get($key) === false) {
          $this->remove($key);
        } else {
          // $this->set($key, $name);
          $save($key, $name);
        }
      }
    } else if ($id = $this->get('id')) {
      foreach (['name', 'label'] as $key) {
        if (!$this->get($key)) {
          $save($key, $id);
        }
      }
    }

    return $this;
  }

  // public function __call($prop, $arguments) {
  //   $this->props($prop, $arguments);
  //   return $this;
  // }
  public function __invoke() {

    if ($this->children->count()) {
      $childs = [];
      foreach ($this->children as $key => $value) {
        $childs[] = $value();
      }
      $this->set('children', $childs);
    }
    return $this->toArray();
  }

  public function addChildren(Input $input): self {
    $input->parent = $this;
    $this->children->add($input);
    return $this;
  }
}
