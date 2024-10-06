<?php

namespace App\DataFixtures;

use App\Entity\PlaylistSubscription;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use DateTimeImmutable;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class PlaylistSubscriptionFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i <= 5; $i++) {
            $subscription = new PlaylistSubscription();
            $subscription->setSubscribedAt(new DateTimeImmutable());

            // Link user and playlist
            $subscription->setUser($this->getReference('user-' . ($i % 10)));
            $subscription->setPlaylist($this->getReference('playlist-' . $i));

            $manager->persist($subscription);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            PlaylistFixtures::class,
            UserFixtures::class,
        ];
    }
}
