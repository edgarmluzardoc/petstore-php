<?php

namespace App\Tests\Helpers;

use App\Entity\Pet;
use App\Helpers\PetHelper;
use PHPUnit\Framework\TestCase;
use InvalidArgumentException;

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
                ],
                [
                    'id' => null,
                    'category' => [],
                    'name' => $testName,
                    'photoUrls' => $testPhotoUrls,
                    'tags' => [],
                    'status' => $availableStatus,
                ],
            ];
        }

        return $testCases;
    }
}
