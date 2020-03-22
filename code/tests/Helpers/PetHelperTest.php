<?php

namespace App\Tests\Helpers;

use App\Entity\{
    Category,
    Pet,
    Tag,
};
use App\Helpers\{
    CategoryHelper,
    PetHelper,
    TagHelper,
};
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class PetHelperTest extends TestCase
{
    /**
     * @param array $petValues
     * @param array $expected
     * @param bool $exceptionExpected
     * @dataProvider dataProviderTestGetModel
     */
    public function testGetModel(
        array $petValues,
        array $expected,
        bool $exceptionExpected = false
    ) {
        if ($exceptionExpected) {
            $this->expectException(InvalidArgumentException::class);
        }
        
        $testPet = new Pet();
        $testPet->setName($petValues['name']);
        $testPet->setPhotoUrls($petValues['photoUrls']);
        $testPet->setStatus($petValues['status']);

        $category = $petValues['category'] ?? null;
        if (!empty($category)) {
            $testPet->setCategory($category);
        }

        $tags = $petValues['tags'] ?? null;
        if (!empty($tags)) {
            foreach ($tags as $tag) {
                $testPet->addTag($tag);
            }
            // Remove last tag to test removeTag functionality
            $testPet->removeTag(end($tags));
        }

        $result = PetHelper::getModel($testPet);
        $this->assertEquals($result, $expected);
    }

    /**
     * Data provider for testGetModel
     */
    public function dataProviderTestGetModel()
    {
        $testName = 'Test pet';
        $testPhotoUrls = ['url1', 'url2'];

        $testCategory = new Category();
        $testCategory->setName('Test category');

        $testTag = new Tag();
        $testTag->setName('Test tag');
        $testTag2 = new Tag();
        $testTag2->setName('Test tag 2');
        $testTag3 = new Tag();    
        $testTag3->setName('Test tag 3');
        $testTags = [$testTag, $testTag2, $testTag3];

        $testCases = [
            'Incorrect status' => [
                [
                    'name' => $testName,
                    'photoUrls' => $testPhotoUrls,
                    'status' => 'incorrect',
                ],
                [],
                true,
            ],
        ];

        $availableStatuses = [
            Pet::STATUS_AVAILABLE,
            Pet::STATUS_PENDING,
            Pet::STATUS_SOLD,
        ];

        foreach ($availableStatuses as $availableStatus) {
            $testCases["Pet, status $availableStatus"] = [
                [
                    'name' => $testName,
                    'photoUrls' => $testPhotoUrls,
                    'status' => $availableStatus,
                    'category' => $testCategory,
                    'tags' => $testTags,
                ],
                [
                    'id' => null,
                    'category' => CategoryHelper::getModel($testCategory),
                    'name' => $testName,
                    'photoUrls' => $testPhotoUrls,
                    'tags' => TagHelper::getTagsModel([$testTag, $testTag2]),
                    'status' => $availableStatus,
                ],
            ];
        }

        return $testCases;
    }
}
