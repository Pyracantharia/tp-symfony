<?php

namespace App\DataFixtures;

use App\Entity\Subscription;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SubscriptionFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Create some fictitious subscriptions
        for ($i = 0; $i < 3; $i++) {
            $subscription = new Subscription();
            $subscription->setName('Subscription Plan ' . ($i + 1));
            $subscription->setPrice(mt_rand(10, 100));
            
            // Set the duration (for example, 30 days)
            $subscription->setDuration(mt_rand(30, 365));  // Random duration between 30 and 365 days

            $manager->persist($subscription);

            // Register this subscription as a reference
            $this->addReference('subscription-' . $i, $subscription);
        }

        $manager->flush();
    }
}
