<?php

namespace App\Helpers;

use App\Entity\Pet;

class PetHelper
{
    /**
     * @param Pet $pet
     * @return array
     */
    public static function getModel(Pet $pet): array
    {
        $category = $pet->getCategory();
        $tagsResults = $pet->getTags()->toArray();

        $tags = [];
        foreach ($tagsResults as $tag) {
            $tags[] = [
                'id' => $tag->getId(),
                'name' => $tag->getName(),
            ];
        }

        return [
            'id' => $pet->getId(),
            'category' => [
                'id' => $category->getId(),
                'name' => $category->getName(),
            ],
            'name' => $pet->getName(),
            'photoUrls' => $pet->getPhotoUrls(),
            'tags' => $tags,
            'status' => $pet->getStatus(),
        ];
    }
}