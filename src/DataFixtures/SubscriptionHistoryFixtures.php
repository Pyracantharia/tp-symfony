<?php

namespace App\DataFixtures;

use App\Entity\SubscriptionHistory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use DateTimeImmutable;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
class SubscriptionHistoryFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i <= 10; $i++) {
            $history = new SubscriptionHistory();
            $history->setStartAt(new DateTimeImmutable('2023-01-' . str_pad((string)$i, 2, '0', STR_PAD_LEFT)));
            $history->setEndAt(new DateTimeImmutable('2023-12-' . str_pad((string)$i, 2, '0', STR_PAD_LEFT)));

            // Link to a user and a subscription
            $history->setSubscriber($this->getReference('user-' . ($i % 3)));
            $history->setSubscription($this->getReference('subscription-' . ($i % 3)));

            $manager->persist($history);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
            SubscriptionFixtures::class,
        ];
    }
}
