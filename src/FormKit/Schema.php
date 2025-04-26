<?php

namespace App\FormKit;

use ApiPlatform\Metadata\IriConverterInterface;
use App\FormKit\Inputs\Component;
use App\FormKit\Inputs\Form;
use App\FormKit\Inputs\Group;
use App\FormKit\Inputs\Html;
use App\FormKit\Inputs\Input;
use App\FormKit\Inputs\Picklist;
use App\Services\Collection;
use App\Services\ReflectionTrait;
use Doctrine\ORM\EntityManagerInterface;
use ReflectionProperty;

class Schema extends Collection {

  use ReflectionTrait;

  public function __construct(protected EntityManagerInterface $entityManager, protected IriConverterInterface $iriConverter) {
  }


  public function formkitSchema(): array {
    return $this->map(fn(Input $v) => $v())->toArray();
  }

  public function inputFactory($data = [], ?Input $parent = null) {

    $inputs = [];
    if (!is_array($data)) {
      $data = [$data];
    }
    foreach ($data as $key => $value) {
      if (\is_array($value)) {
        $group = Group::create();
        $inputs[] = $group;
        $this->inputFactory($value, $group);
      } else {
        if (is_string($value)) {
          $value = $this->reflectionField($value);
        }
        if (\is_a($value, Input::class)) {
          if ($parent) {
            $parent->addChildren($value);
          } else {
            $inputs[] = $value;
          }
        }
      }
    }
    return $inputs;
  }

  public function build($entity, array $entitySchema = []): self {

    $this->entity = $entity;

    if (!empty($entitySchema)) {
      $this->add($this->arrayToSchema(new Collection($entitySchema)));
    } else {
      foreach ($this->properties as $key => $value) {
        // $value = new ReflectionProperty();
        $this->add($this->reflectionField($value->getName()));
      }
    }

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
}
