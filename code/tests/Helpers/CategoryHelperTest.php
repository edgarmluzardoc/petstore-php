<?php

namespace App\Tests\Helpers;

use App\Entity\Category;
use App\Helpers\CategoryHelper;
use PHPUnit\Framework\TestCase;

class CategoryHelperTest extends TestCase
{
    /**
     * @param Category|null $category
     * @param array $expected
     * @dataProvider dataProviderTestGetModel
     */
    public function testGetModel(?Category $category, array $expected)
    {
        $result = CategoryHelper::getModel($category);
        $this->assertEquals($result, $expected);
    }

    /**
     * Data provider for testGetModel
     */
    public function dataProviderTestGetModel()
    {
        $testCategory = new Category();
        $testCategory->setName('Test category');

        return [
            'Empty category' => [
                null,
                [],
            ],
            'Category 1' => [
                $testCategory,
                [
                    'id' => $testCategory->getId(),
                    'name' => $testCategory->getName(),
                ],
            ],
        ];
    }
}
