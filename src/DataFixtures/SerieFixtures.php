<?php

namespace App\DataFixtures;

use App\Entity\Serie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class SerieFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        
        for ($i = 0; $i <= 3; $i++) {
            $serie = new Serie();
            $serie->setShortDescription('Short description of serie ' . $i);
            $serie->setLongDescription('Long description of serie ' . $i);
            $serie->setReleaseDate(new \DateTimeImmutable());
            $serie->setTitle('Serie ' . $i);
            $serie->setCoverImage('serie-' . $i . '.jpg');

            

            $manager->persist($serie);

            // Register this serie as a reference
            $this->addReference('serie-' . $i, $serie);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            MediaFixtures::class,
        ];
    }
}
