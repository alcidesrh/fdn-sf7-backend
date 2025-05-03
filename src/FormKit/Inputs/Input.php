<?php

namespace App\FormKit\Inputs;

use App\Services\Collection;

class Input extends Collection {

  public Collection $children;

  public self $parent;

  public string $type;

  public function __construct($elements) {
    $this->children = new Collection();
    parent::__construct($elements);
  }
  /**
   * {@inheritDoc}
   */
  public function set(string|int $key, mixed $value): self {
    parent::set($key, $value);
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

  public function addChildren(Input|array $input): self {
    if (!is_array($input)) {
      $input = [$input];
    }
    foreach ($input as $value) {
      if (\is_a($value, Input::class)) {
        $value->parent = $this;
        $this->children->add($value);
      }
    }
    return $this;
  }

  public function validation($validation = 'required'): self {
    $this->set('validation', $validation);
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
}
