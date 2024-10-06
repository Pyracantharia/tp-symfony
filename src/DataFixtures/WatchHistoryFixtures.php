<?php

namespace App\DataFixtures;

use App\Entity\WatchHistory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use DateTimeImmutable;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class WatchHistoryFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i <= 10; $i++) {
            $watchHistory = new WatchHistory();
            $watchHistory->setLastWatchedAt(new DateTimeImmutable());
            $watchHistory->setNumberOfViews(mt_rand(1, 10));

            // Link user and media
            $watchHistory->setWatcher($this->getReference('user-' . ($i % 3)));
            $watchHistory->setMedia($this->getReference('media-' . ($i % 5)));

            $manager->persist($watchHistory);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
            MovieFixtures::class, // Assuming movies are the media being watched
        ];
    }
}
