<?php

namespace App\DataFixtures;

use App\Entity\Language;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class LanguageFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $languages = [
            ['name' => 'English', 'code' => 'EN'],
            ['name' => 'French', 'code' => 'FR'],
            ['name' => 'Spanish', 'code' => 'ES'],
            ['name' => 'German', 'code' => 'DE'],
            ['name' => 'Italian', 'code' => 'IT'],
        ];

        foreach ($languages as $key => $lang) {
            $language = new Language();
            $language->setName($lang['name']);
            $language->setCode($lang['code']);

            $manager->persist($language);

            // Register this language as a reference
            $this->addReference('language-' . $key, $language);
        }

        $manager->flush();
    }
}
