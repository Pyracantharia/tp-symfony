<?php

namespace App\DataFixtures;

use App\Entity\Movie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Enum\MediaTypeEnum;

class MovieFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i <= 10; $i++) {
            $movie = new Movie();
            $movie->setTitle('Movie ' . $i);
            $movie->setShortDescription('Description of movie ' . $i);
            $movie->setLongDescription('Long description of movie ' . $i);
            $movie->setReleaseDate(new \DateTimeImmutable('2022-01-' . str_pad((string)$i, 2, '0', STR_PAD_LEFT)));
            $movie->setCoverImage('image' . $i . '.jpg');
            //$movie->setMediaType([MediaTypeEnum::VIDEO]);

            // Add categories and languages
            $movie->addCategory($this->getReference('category-' . ($i % 5)));
            $movie->addLanguage($this->getReference('language-' . ($i % 5)));

            $manager->persist($movie);

            // Register this movie as a reference
            $this->addReference('movie-' . $i, $movie);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            CategoryFixtures::class,
            LanguageFixtures::class,
        ];
    }
}
