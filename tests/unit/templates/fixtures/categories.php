<?php
/**
 * @var $faker \Faker\Generator
 * @var $index int
 */

use app\models\Category;
use yii\helpers\Inflector;

$parent_id = null;

if ($index + 1 > 40) {
    $parent_id = rand(10, 40);
} elseif ($index + 1 > 10) {
    $parent_id = rand(1, 10);
}

return [
    'id' => $index + 1,
    'parent_id' => $parent_id,
    'title' => $title = $faker->unique()->firstName,
    'slug' => Inflector::slug(implode('-', explode(' ', $title))),
    'status' => $faker->randomElement(array_keys(Category::getStatuses())),
    'created_at' => $date = $faker->dateTimeBetween('-1 year')->format('Y-m-d H:i:s'),
    'updated_at' => $date
];