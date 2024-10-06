<?php

namespace App\DataFixtures;

use App\Entity\Season;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;


class SeasonFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i <= 3; $i++) {
            $season = new Season();
            $season->setNumber((string)$i);

            // Link to a serie
            $season->setSerie($this->getReference('serie-' . $i));

            $manager->persist($season);

            // Register this season as a reference
            $this->addReference('season-' . $i, $season);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            SerieFixtures::class,
        ];
    }
}
