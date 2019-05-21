<?php

namespace app\helpers;

use app\models\Category;

/**
 * Class CategoryHelper
 * @package app\helpers
 */
class CategoryHelper
{
    /**
     * @param Category[] $categories
     * @param array $result
     * @param string $prefix
     *
     * @return array
     */
    public static function getTree(array $categories, array $result = [], string $prefix = '-')
    {
        $defaultPrefix = '-';

        foreach ($categories as $category) {
            $result[$category->id] = $prefix . ' ' . $category->title;

            if (count($category->children) > 0) {
                $result = self::getTree($category->children, $result,$prefix . $defaultPrefix);
            }
        }

        return $result;
    }
}