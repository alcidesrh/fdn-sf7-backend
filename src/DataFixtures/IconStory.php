<?php

namespace App\DataFixtures;

use App\DataFixtures\Factory\IconCategoryFactory;
use App\DataFixtures\Factory\IconFactory;
use App\Entity\IconCategory;
use App\Services\Collection;
use Doctrine\ORM\EntityManagerInterface;
use Zenstruck\Foundry\Attribute\AsFixture;
use Zenstruck\Foundry\Story;
use function Symfony\Component\String\u;
use function Zenstruck\Foundry\Persistence\flush_after;
use Doctrine\Persistence\ObjectManager;

#[AsFixture(name: 'icon')]
final class IconStory extends Story {

    public function __construct(private EntityManagerInterface $em) {
    }

    //[X]   symfony console foundry:load-fixtures -a icon
    public function build(): void {

        // $temp = array_chunk(IconFactory::icons(), 50);
        foreach (IconFactory::icons() as $key => $value) {
            $category = IconCategoryFactory::new(['name' => $key])->create();
            $value = \array_unique($value);
            \ksort($value);
            $value = \count($value) > 100 ? \array_chunk($value, 100) : [$value];
            // flush_after(function () use ($value, $category) {


            foreach ($value as  $value2) {
                foreach ($value2 as $i) {
                    $category->addIcon(IconFactory::new(['name' => u($i)->replace('_', ' ')->title(allWords: true)->toString(), 'icon' => $i])->create());
                }
            }
            $this->em->flush();
            $this->em->clear();
            // });
        }
    }
}
