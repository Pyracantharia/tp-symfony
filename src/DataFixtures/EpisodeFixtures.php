<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use DateTimeImmutable;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i <= 10; $i++) {
            $episode = new Episode();
            $episode->setTitle('Episode ' . $i);
            $episode->setDuration(mt_rand(30, 60)); // Durée entre 30 et 60 minutes
            $episode->setReleasedAt(new DateTimeImmutable('2022-01-' . str_pad((string)$i, 2, '0', STR_PAD_LEFT)));

            // Récupérer une saison fictive
            $season = $this->getReference('season-' . ($i % 3));
            $episode->setSeason($season);

            $manager->persist($episode);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            SeasonFixtures::class,
        ];
    }
}
