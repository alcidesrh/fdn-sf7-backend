<?php

namespace App\Services;

use function Symfony\Component\String\u;

use ApiPlatform\Doctrine\Common\PropertyHelperTrait;
use App\Attribute\AttributeUtil;
use App\Attribute\FormKitCreateExclude;
use App\Attribute\FormKitFieldOrder;
use App\Attribute\FormKitLabel;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\Mapping\ClassMetadata;
use ReflectionClass;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Symfony\Component\PropertyInfo\PropertyInfoExtractor;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\Finder\Finder;

#[Attribute]
class FormKitGenerate {
    use PropertyHelperTrait;
    private ArrayCollection $form;

    public function __construct(private EntityManagerInterface $entityManager, private AttributeUtil $attributeUtil) {
        $this->form = new ArrayCollection();
    }

    public function create($className) {

        if ($className == 'entity') {
            return [[
                '$formkit' => 'select',
                'label' => 'Entidades',
                'name' => 'entity',
                'options' => $this->attributeUtil->getResources(true)
            ]];
        }
        try {
            $className = u($className)->camel()->title();
            $className = "App\Entity\\$className";

            $reflectionClass = new ReflectionClass($className);

            $info = AttributeUtil::getExtractor();
            $properties = $info->getProperties($className);

            if ($order = $reflectionClass->getAttributes(FormKitFieldOrder::class)) {
                $order = $order[0]->newInstance()->order;
                $properties = array_merge($order, array_diff($properties, $order,));
            }

            // $metadata = $this->getClassMetadata($className);
            // $properties = \array_merge($metadata->getFieldNames(), $metadata->getAssociationNames());
            foreach ($properties as $value) {
                // $mapped =    $this->enisPropertyMapped($value, $className);
                try {
                    $attrs = $reflectionClass->getProperty($value)->getAttributes();

                    if (\in_array(FormKitCreateExclude::class, \array_map(fn ($i) => $i->getName(), $attrs))) {
                        continue;
                    }
                } catch (\ReflectionException $th) {
                    continue;
                }

                if (!$typeInfo = $info->getTypes($className, $value)) {
                    continue;
                }
                $type = $typeInfo[0]->getBuiltinType();
                $collectionValueTypes = $typeInfo[0]->getCollectionValueTypes();

                if (!empty($collectionValueTypes)) {
                    $class =  $collectionValueTypes[0]->getClassName();
                } else {
                    $class = $typeInfo[0]?->getClassName();
                }

                $label = null;
                if ($labelAttrb = array_filter($attrs, fn ($i) => $i->getName() == FormKitLabel::class)) {
                    $label = $labelAttrb[0]->newInstance()->label;
                }

                $data[] = [
                    'name' => $value,
                    'label' => $label ?? $value,
                    'type' => $type,
                    'class' => $class

                ];
            }

            return $this->getForm($data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }


    public function getForm(array $data) {

        $form = [];
        foreach ($data as $key => $value) {

            list($name, $label, $type, $class) = \array_values($value);

            $input = self::getInputType($type, $class);

            $form[] = [
                '$formkit' => $input,
                'label' => \ucwords($label),
                'name' => \strtolower($name),
                'labelClass' => 'text',
                'validation' => 'required'
            ];

            $aux = function ($el) {
                return ['label' => (string)$el, 'value' => $el->getId()];
            };

            if ($input == 'select' && $class && $class != DateTimeInterface::class) {
                $form[$key]['options']  = (new ArrayCollection($this->entityManager->getRepository($class)->findAll()))->map($aux)->toArray();
            }
            if ($type == 'array') {
                $form[$key]['multiple'] = true;
            }
        }

        // return [$form[0], $form[2], $form[3], $form[1], $form[4]];

        return $form;
    }



    static function getInputType($type, $class) {

        if ($type == 'object' || $type == 'array') {
            if ($class == DateTimeInterface::class) {
                return 'date';
            }
            return 'select';
        }
        return 'text';
    }

    public function entityList() {
        $finder = new Finder();
        // find all files in the current directory
        $finder->files()->in($this->entityDir)->depth(0);
        $options = [['label' => 'Entidades', 'value' => 0]];
        foreach ($finder as $file) {
            $options[] = ['label' => $file->getFilenameWithoutExtension(), 'value' => $file->getFilenameWithoutExtension()];
        }

        return $options;
    }
    public function getClassMetadata(string $classResource): ClassMetadata {
        return $this->entityManager->getClassMetadata($classResource);
    }
}
