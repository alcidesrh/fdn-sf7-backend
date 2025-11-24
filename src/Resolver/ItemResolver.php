<?php

namespace App\Resolver;

use ApiPlatform\GraphQl\Resolver\QueryItemResolverInterface;
use ApiPlatform\Metadata\IriConverterInterface;
use App\DTO\MetadataDTO;
use App\Entity\User;
use App\Repository\FormSchemaRepository;
use App\Services\ServerSentEvent;
use App\Useful\Doctrine;
use AutoMapper\AutoMapperInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;

final class ItemResolver implements QueryItemResolverInterface {

  public function __construct(private EntityManagerInterface $entityManagerInterface, private IriConverterInterface $iriConverter,  private FormSchemaRepository $repo, private ServerSentEvent $serverSentEvent, private AutoMapperInterface $autoMapper) {
  }
  /**
   */
  public function __invoke(?object $item, array $context): object {


    // if (!empty($context['args']['form'])) {
    //   $form = (new Schema($this->entityManagerInterface, $this->iriConverter, $this->repo, $context['args']['entity']))->getSchema();
    //   // $schema = $form->getSchemaJson();
    // $this->serverSentEvent->form($form);
    // }
    if (!empty($context['args']['id'])) {
      $item = $this->entityManagerInterface->getRepository(Doctrine::entityNamespace($context['args']['entity']))->find($context['args']['id']);

      $class = (new User())->setNombre('Guatemala');
      $test = $this->autoMapper->map($item, 'array');
    }
    return  new MetadataDTO();
    $metadata = new MetadataDTO();
    $metadata->data = ['collection' => (new ArrayCollection($this->entityManagerInterface->getRepository(Doctrine::entityNamespace($context['args']['resource']))->findAll()))->map(fn($v) => ['value' => $this->iriConverter->getIriFromResource($v), 'label' => $v->getLabel()])];

    return $metadata;
  }
}
