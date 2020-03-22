<?php

namespace App\Tests\Helpers;

use App\Entity\Tag;
use App\Helpers\TagHelper;
use PHPUnit\Framework\TestCase;

class TagHelperTest extends TestCase
{
    /**
     * @param Tag|null $tag
     * @param array $expected
     * @dataProvider dataProviderTestGetModel
     */
    public function testGetModel(?Tag $tag, array $expected)
    {
        $result = TagHelper::getModel($tag);
        $this->assertEquals($result, $expected);
    }

    /**
     * Data provider for testGetModel
     */
    public function dataProviderTestGetModel()
    {
        $testTag = new Tag();
        $testTag->setName('Test tag');

        return [
            'Empty tag' => [
                null,
                [],
            ],
            'Tag 1' => [
                $testTag,
                [
                    'id' => $testTag->getId(),
                    'name' => $testTag->getName(),
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
