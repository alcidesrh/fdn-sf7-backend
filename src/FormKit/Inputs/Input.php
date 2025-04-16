<?php

namespace App\FormKit\Inputs;

use App\Services\Collection;
use App\Services\FormkitReflection;
use function Symfony\Component\String\u;

class Input extends Collection {

  public static $inputBase = ['name' => '', 'label' => '', 'validation' => false];

  public Collection $children;

  public self $parent;

  public string $type;

  public function __construct($elements) {
    $this->children = new Collection();
    parent::__construct($elements);
  }

  public function group($arg = []): self {
    $input = (new self(['$formkit' => 'group']));
    return $this->common($input, $arg);
  }

  public function html($self = true, $args = []): Input {
    $input = new Html($args);
    $this->addChildren($input);
    return $self ? $input : $this;
  }

  public function fieldset($self = true, $args = []): Input {
    $input = Component::createFieldset($args);
    $this->addChildren($input);
    return $self ? $input : $this;
  }

  public function picklist($self = true, $args = []): Input {
    $input = Picklist::create($args);
    $this->addChildren($input);
    return $self ? $input : $this;
  }


  public function root($input = false) {
    $input = $input ?: $this;
    if ($input->parent) {
      return $this->root($input);
    } else {
      return $this;
    }
  }


  public function accordion($self = true, $args = []): Input {
    $input = Component::createAccordion($args);
    $this->addChildren($input);
    return $self ? $input : $this;
  }

  public function ascend($up = 1): self {
    $input = $this;
    for ($i = 0; $i < $up; $i++) {
      if ($input::class == Form::class) {
        break;
      }
      $input = $input->parent;
    }
    return $input;
  }
  /**
   * {@inheritDoc}
   */
  public function set(string|int $key, mixed $value): self {
    parent::set($key, $value);
    return $this;
  }

  public function children(mixed $data): self {

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


  public function validation($validation = 'required'): self {
    $this->set('validation', $validation);
    return $this;
  }
}
