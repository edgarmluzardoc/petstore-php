<?php

namespace App\Helpers;

use App\Entity\Category;

class CategoryHelper
{
    /**
     * @param Category|null $category
     * @return array
     */
    public static function getModel(?Category $category): array
    {
        if (empty($category)) {
            return [];
        }

        return [
            'id' => $category->getId(),
            'name' => $category->getName(),
        ];
    }
}
