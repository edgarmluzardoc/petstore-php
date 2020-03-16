<?php

namespace App\Helpers;

use App\Entity\Tag;

class TagHelper
{
    /**
     * @param Tag|null $category
     * @return array
     */
    public static function getModel(?Tag $tag): array
    {
        if (empty($tag)) {
            return [];
        }

        return [
            'id' => $tag->getId(),
            'name' => $tag->getName(),
        ];
    }

    /**
     * @param array $tags
     * @return array
     */
    public static function getTagsModel(array $tags): array
    {
        $tagsFormatted = [];
        foreach ($tags as $tag) {
            $tagsFormatted[] = self::getModel($tag);
        }

        return $tagsFormatted;
    }
}