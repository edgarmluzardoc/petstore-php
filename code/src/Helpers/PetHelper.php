<?php

namespace App\Helpers;

use App\Entity\Pet;
use App\Helpers\{
    CategoryHelper,
    TagHelper,
};

class PetHelper
{
    /**
     * @param Pet $pet
     * @return array
     */
    public static function getModel(Pet $pet): array
    {
        $category = CategoryHelper::getModel($pet->getCategory());
        $tags = TagHelper::getTagsModel($pet->getTags()->toArray());

        return [
            'id' => $pet->getId(),
            'category' => $category,
            'name' => $pet->getName(),
            'photoUrls' => $pet->getPhotoUrls(),
            'tags' => $tags,
            'status' => $pet->getStatus(),
        ];
    }
}
