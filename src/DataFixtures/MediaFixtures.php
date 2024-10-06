<?php

namespace App\DataFixtures;

use App\Entity\Media;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use DateTimeImmutable;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\Entity\Movie;
use App\Entity\Serie;

class MediaFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        
        for ($i = 0; $i <= 10; $i++) {
        
                $media = new Movie(); // Crée un Movie pour les éléments pairs
           

            // Définir les valeurs requises pour tous les champs obligatoires
            $media->setTitle('Media ' . $i);
            $media->setShortDescription('Description of media ' . $i);  // Assurez-vous que cette valeur est bien définie
            $media->setLongDescription('Long description of media ' . $i);
            $media->setReleaseDate(new DateTimeImmutable('2022-01-' . str_pad((string)$i, 2, '0', STR_PAD_LEFT)));
            $media->setCoverImage('media' . $i . '.jpg');

            // Ajout de catégories et langues
            $media->addCategory($this->getReference('category-' . ($i % 5)));
            $media->addLanguage($this->getReference('language-' . ($i % 5)));

            $manager->persist($media);

            // Enregistrez cette media en tant que référence
            $this->addReference('media-' . $i, $media);
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
