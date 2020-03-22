<?php

namespace App\Tests\Helpers;

use App\Entity\{
    Pet,
    Tag,
};
use App\Helpers\TagHelper;
use PHPUnit\Framework\TestCase;

class TagHelperTest extends TestCase
{
    /**
     * @param array|null $tagValues
     * @param array $expected
     * @dataProvider dataProviderTestGetModel
     */
    public function testGetModel(?array $tagValues, array $expected)
    {
        $testTag = null;
        if (!empty($tagValues)) {
            $testTag = new Tag();
            $testTag->setName($tagValues['name']);

            // Testing pet actions
            $pets = $tagValues['pets'] ?? null;
            if (!empty($pets)) {
                foreach ($pets as $pet) {
                    $testTag->addPet($pet);
                }
                // Remove pet to test removePet
                $testTag->removePet(end($pets));

                $this->assertEquals($testTag->getPets()->toArray(), $expected['pets']);
                unset($expected['pets']);
            }
        }

        $result = TagHelper::getModel($testTag);
        $this->assertEquals($result, $expected);
    }

    /**
     * Data provider for testGetModel
     */
    public function dataProviderTestGetModel()
    {
        $testName = 'Test tag';

        $testPet = new Pet();
        $testPet2 = new Pet();
        $testPets = [$testPet, $testPet2];

        return [
            'Empty tag' => [
                null,
                [],
            ],
            'Tag 1' => [
                [
                    'name' => $testName,
                    'pets' => $testPets,
                ],
                [
                    'id' => null,
                    'name' => $testName,
                    'pets' => [$testPet],
                ],
            ],
        ];
    }

    /**
     * @param array $tags
     * @param array $expected
     * @dataProvider dataProviderTestGetTagsModels
     */
    public function testGetTagsModel(array $tags, array $expected)
    {
        $result = TagHelper::getTagsModel($tags);
        $this->assertEquals($result, $expected);
    }

    /**
     * Data provider for testGetModel
     */
    public function dataProviderTestGetTagsModels()
    {
        $testTag = new Tag();
        $testTag->setName('Test tag');

        return [
            'Empty tags' => [
                [],
                [],
            ],
            'Single tag' => [
                [$testTag],
                [
                    [
                        'id' => $testTag->getId(),
                        'name' => $testTag->getName(),
                    ]
                ],
            ],
            'Multiple tags' => [
                [$testTag, $testTag],
                [
                    [
                        'id' => $testTag->getId(),
                        'name' => $testTag->getName(),
                    ],
                    [
                        'id' => $testTag->getId(),
                        'name' => $testTag->getName(),
                    ],
                ],
            ],
        ];
    }
}
