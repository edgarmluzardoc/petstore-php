<?php

namespace App\DataFixtures;

use App\Entity\{
    Category,
    Pet,
    Tag,
};
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class AppFixtures
 * @codeCoverageIgnore
 */
class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // Creating Tags to be used
        $tag1 = $this->createTag($manager, 'Tag 1');
        $tag2 = $this->createTag($manager, 'Tag 2');
        $tag3 = $this->createTag($manager, 'Tag 3');

        // Creating Categories to be used
        $category1 = $this->createCategory($manager, 'Category 1');
        $this->createCategory($manager, 'Category 2');
        $this->createCategory($manager, 'Category 3');

        $totalPets = 5;
        for ($i = 1; $i <= $totalPets; $i++) {
            // Creating a Pet
            $pet = new Pet();
            $pet->setName("Pet $i");
            $pet->setPhotoUrls([
                'https://example-photo-url-1.com',
                'https://example-photo-url-2.com',
                'https://example-photo-url-3.com',
            ]);
            $pet->setStatus(Pet::STATUS_AVAILABLE);

            // Adding Tags to a pet
            $pet->addTag($tag1);
            $pet->addTag($tag2);
            $pet->addTag($tag3);

            // Adding a Category to a pet
            $pet->setCategory($category1);

            $manager->persist($pet);
        }

        $manager->flush();
    }

    public function createCategory(ObjectManager $manager, string $name): Category
    {
        $category = new Category();
        $category->setName($name);
        $manager->persist($category);

        return $category;
    }

    public function createTag(ObjectManager $manager, string $name): Tag
    {
        $tag = new Tag();
        $tag->setName($name);
        $manager->persist($tag);

        return $tag;
    }
}
