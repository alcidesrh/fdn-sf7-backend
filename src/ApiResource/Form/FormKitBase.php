<?php

namespace App\ApiResource\Form;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class FormKitBase {

  public static function formKitSchema(array &$value, $entityManager) {

    list($name, $label, $type, $class) = \array_values($value);

    $input = self::getInputType($type, $class);

    $schema = [
      '$formkit' => $input,
      'label' => \ucwords($label),
      'name' => \strtolower($name),
      'validation' => 'required'
    ];

    $aux = function ($el) {
      return ['label' => (string)$el, 'value' => $el->getId()];
    };

    if (($input == 'select_fdn' || $input == 'multiselect_fdn') && $class && $class != \DateTime::class) {
      if (\enum_exists($class)) {
        $schema['options']  = array_map(
          fn($enumItem) => ['label' => $enumItem->value, 'value' => $enumItem->value],
          $class::cases()
        );
      } else {
        $schema['options']  = (new ArrayCollection($entityManager->getRepository($class)->findAll()))->map($aux)->toArray();
      }
    }
    if ($type == 'array') {
      $schema['multiple'] = true;
    }

    return $schema;
  }

  final static function getInputType($type, $class) {

    if (!in_array($type, ['string', 'int'])) {
      if (in_array($class, [DateTimeInterface::class, DateTime::class])) {
        return 'datepicker_fdn';
      } elseif ($type == Collection::class || $type == 'array') {
        return 'multiselect_fdn';
      }
      return 'select_fdn';
    }
    return 'text_fdn';
  }
}
