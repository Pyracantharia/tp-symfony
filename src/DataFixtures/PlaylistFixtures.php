<?php

namespace App\DataFixtures;

use App\Entity\Playlist;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use DateTimeImmutable;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class PlaylistFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 6; $i++) {  // Commence à 0 pour correspondre à PlaylistMediaFixtures
            $playlist = new Playlist();
            $playlist->setName('Playlist ' . ($i + 1));
            $playlist->setCreatedAt(new DateTimeImmutable());
            $playlist->setUpdatedAt(new DateTimeImmutable());

            // Associate a user
            $playlist->setUser($this->getReference('user-' . ($i % 10)));

            $manager->persist($playlist);

            // Register this playlist as a reference
            $this->addReference('playlist-' . $i, $playlist);  // Utilise 'playlist-0', 'playlist-1', etc.
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
        ];
    }
}
