<?php

namespace App\DataFixtures;

use App\Entity\PlaylistMedia;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use DateTimeImmutable;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class PlaylistMediaFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i <= 10; $i++) {
            $playlistMedia = new PlaylistMedia();
            $playlistMedia->setAddedAt(new DateTimeImmutable());

            // Link playlist and media
            $playlistMedia->setPlaylist($this->getReference('playlist-' . ($i % 5)));
            $playlistMedia->setMedia($this->getReference('media-' . $i));

            $manager->persist($playlistMedia);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            PlaylistFixtures::class,
            MovieFixtures::class,  // Assuming movies are part of the media
        ];
    }
}
