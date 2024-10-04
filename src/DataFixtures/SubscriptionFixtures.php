<?php

namespace App\DataFixtures;

use App\Entity\Subscription;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SubscriptionFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Création de quelques souscriptions fictives
        for ($i = 0; $i < 3; $i++) {
            $subscription = new Subscription();
            $subscription->setName('Subscription Plan ' . ($i + 1));
            $subscription->setPrice(mt_rand(10, 100));

            $manager->persist($subscription);

            // Enregistrer cette souscription comme référence
            $this->addReference('subscription-' . $i, $subscription);
        }

        $manager->flush();
    }
}
