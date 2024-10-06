<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $categories = ['Action', 'Drama', 'Comedy', 'Horror', 'Sci-Fi'];

        foreach ($categories as $key => $categoryName) {
            $category = new Category();
            $category->setName($categoryName);
            $category->setLabel(ucfirst($categoryName) . ' Category');

            $manager->persist($category);

            // Register this category as a reference
            $this->addReference('category-' . $key, $category);
        }

        $manager->flush();
    }
}