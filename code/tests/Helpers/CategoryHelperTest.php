<?php

namespace App\Tests\Helpers;

use App\Entity\{
    Category,
    Pet,
};
use App\Helpers\CategoryHelper;
use PHPUnit\Framework\TestCase;

class CategoryHelperTest extends TestCase
{
    /**
     * @param array|null $categoryValues
     * @param array $expected
     * @dataProvider dataProviderTestGetModel
     */
    public function testGetModel(?array $categoryValues, array $expected)
    {
        $testCategory = null;
        if (!empty($categoryValues)) {
            $testCategory = new Category();
            $testCategory->setName($categoryValues['name']);
            
            // Testing pet actions
            $pets = $categoryValues['pets'] ?? null;
            if (!empty($pets)) {
                foreach ($pets as $pet) {
                    $testCategory->addPet($pet);
                }
                // Remove pet to test removePet
                $testCategory->removePet(end($pets));

                $this->assertEquals($testCategory->getPets()->toArray(), $expected['pets']);
                unset($expected['pets']);
            }
        }

        $result = CategoryHelper::getModel($testCategory);
        $this->assertEquals($result, $expected);
    }

    /**
     * Data provider for testGetModel
     */
    public function dataProviderTestGetModel()
    {
        $testName = 'Test category';

        $testPet = new Pet();
        $testPet2 = new Pet();
        $testPets = [$testPet, $testPet2];

        return [
            'Empty category' => [
                null,
                [],
            ],
            'Category 1' => [
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
}
